<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Language\Language;
use Grav\Common\Plugin;
use Grav\Common\Session;
use Grav\Common\Uri;
use Grav\Common\User\User;
use Grav\Plugin\Login\Events\UserLoginEvent;
use Grav\Plugin\Login\Login;
use Grav\Plugin\Login\OAuth2\OAuth2;
use Grav\Plugin\Login\OAuth2\ProviderFactory;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\Session\Message;

/**
 * Class GravPluginLoginOauth2Plugin
 * @package Grav\Plugin
 */
class LoginOauth2Plugin extends Plugin
{

    protected $admin = false;

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ],
        ];
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload()
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onTwigLoader()
    {
        $media_paths = $this->grav['locator']->findResources('plugins://login-oauth2/media');
        foreach(array_reverse($media_paths) as $images_path) {
            $this->grav['twig']->addPath($images_path, 'oauth2-media');
        }
    }

    /**
     * [onTwigTemplatePaths] Add twig paths to plugin templates.
     */
    public function onTwigTemplatePaths()
    {
        $twig = $this->grav['twig'];
        $twig->twig_paths[] = __DIR__ . '/templates';
    }

    public function onTwigSiteVariables()
    {
        // add CSS for frontend if required
        if ((!$this->isAdmin() && $this->config->get('plugins.login-oauth2.built_in_css')) ||
            ($this->admin && $this->config->get('plugins.login-oauth2.admin.built_in_css'))) {
            $this->grav['assets']->add('plugin://login-oauth2/css/login-oauth2.css');
        }
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin() && $this->grav['config']->get('plugins.login-oauth2.admin.enabled')) {
            $this->admin = true;
        }

        // Don't proceed if we are in the admin plugin
        if ( $this->isAdmin() && !$this->admin) {
            return;
        }

        $this->enable([
                'onTask.login.oauth2'       => ['loginRedirect', 0],
                'onTask.callback.oauth2'    => ['loginCallback', 0],
                'onTwigLoader'              => ['onTwigLoader', 0],
                'onTwigTemplatePaths'       => ['onTwigTemplatePaths', 0],
                'onTwigSiteVariables'       => ['onTwigSiteVariables', 0],
                'onLoginPage'               => ['onLoginPage', 10],
                'onUserLoginAuthenticate'   => ['userLoginAuthenticate', 1000],
                'onUserLoginFailure'        => ['userLoginFailure', 0],
                'onUserLogin'               => ['userLogin', 0],
                'onUserLogout'              => ['userLogout', 0],
                'onOAuth2Username'          => ['onOAuth2Username', 0],
            ]
        );

        // Check to ensure login plugin is enabled.
        if (!$this->grav['config']->get('plugins.login.enabled')) {
            throw new \RuntimeException('The Login plugin needs to be installed and enabled');
        }

        // Add OAuth2 object to Grav
        $oauth2 = new OAuth2($this->admin);
        $oauth2->addEnabledProviders();

        $this->grav['oauth2'] = $oauth2;
    }

    /**
     * Add navigation item to the admin plugin
     */
    public function onLoginPage()
    {
        if ($this->grav['oauth2']->getProviders()) {
            $this->grav['login']->addProviderLoginTemplate('login-oauth2/login-oauth2.html.twig');
        }
    }

    /**
     * Task: login.oauth2
     */
    public function loginRedirect()
    {
        /** @var OAuth2 $oauth2 */
        $oauth2 = $this->grav['oauth2'];

        $user = isset($this->grav['user']) ? $this->grav['user'] : null;
        if ($user && $user->authorized) {
            throw new \RuntimeException('You have already been logged in', 403);
        }

        $provider_name = filter_input(INPUT_POST,'oauth2',FILTER_SANITIZE_STRING,!FILTER_FLAG_STRIP_LOW);

        if (!isset($provider_name)) {
            throw new \RuntimeException('Bad Request', 400);
        }

        if ($oauth2->isValidProvider($provider_name)) {

            $provider = ProviderFactory::create($provider_name);

            /** @var Session $session */
            $session = $this->grav['session'];
            $session->oauth2_state = $provider->getState();
            $session->oauth2_provider = $provider_name;

            $authorizationUrl = $provider->getAuthorizationUrl();

            $this->grav->redirect($authorizationUrl);
        }
    }

    /**
     * Task: callback.oauth2
     */
    public function loginCallback()
    {
        /** @var Login $login */
        $login = $this->grav['login'];

        /** @var OAuth2 $oauth2 */
        $oauth2 = $this->grav['oauth2'];

        /** @var Session $session */
        $session = $this->grav['session'];
        $provider_name = $session->oauth2_provider;

        /** @var Language $t */
        $t = $this->grav['language'];
        /** @var Message $messages */
        $messages = $this->grav['messages'];



        if ($oauth2->isValidProvider($provider_name)) {

            $state = filter_input(INPUT_GET, 'state', FILTER_SANITIZE_STRING, !FILTER_FLAG_STRIP_LOW);

            // try POST
            if (empty($state)) {
                $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING, !FILTER_FLAG_STRIP_LOW);
            }

            if (empty($state) || ($state !== $session->oauth2_state)) {
                unset($session->oauth2_state);
                // TODO: better error message?
                $messages->add($t->translate('PLUGIN_LOGIN.LOGIN_FAILED'), 'error');
            } else {
                // Fire Login process.
                $event = $login->login([], ['remember_me' => true, 'oauth2' => true, 'provider' => $provider_name], ['return_event' => true]);
                $user = $event->getUser();

                if ($user->authenticated) {
                    $event->defMessage('PLUGIN_LOGIN.LOGIN_SUCCESSFUL', 'info');

                    $event->defRedirect(
                        $this->grav['session']->redirect_after_login
                            ?: LoginPlugin::defaultRedirectAfterLogin()
                            ?: $this->grav['uri']->referrer('/')
                    );
                } else {
                    if ($user->username) {
                        $event->defMessage('PLUGIN_LOGIN.ACCESS_DENIED', 'error');

                        $event->defRedirect($this->grav['config']->get('plugins.login.route_unauthorized', '/'));
                    } else {
                        $event->defMessage('PLUGIN_LOGIN.LOGIN_FAILED', 'error');
                    }
                }

                $message = $event->getMessage();
                if ($message) {
                    $messages->add($t->translate($message), $event->getMessageType());
                }

                $redirect = $event->getRedirect();
                if ($redirect) {
                    $this->grav->redirect($redirect, $event->getRedirectCode());
                }
            }
        } else {
            // TODO: better error message?
            $messages->add($t->translate('PLUGIN_LOGIN.LOGIN_FAILED'), 'error');
        }

        $uri = $this->grav['uri'];
        $redirect = $uri->url(true);
        $this->grav->redirect($redirect);
    }

    public function userLoginAuthenticate(UserLoginEvent $event)
    {

        // Second parameter of Login::login() call.
        $options = $event->getOptions();

        if (isset($options['oauth2'])) {

            $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING, !FILTER_FLAG_STRIP_LOW);

            // try POST
            if (!$code) {
                $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING, !FILTER_FLAG_STRIP_LOW);
            }
            $provider_name = $options['provider'];
            $provider = ProviderFactory::create($provider_name, $options);

            try {

                // Try to get an access token (using the authorization code grant)
                $token = $provider->getAccessToken('authorization_code', ['code' => $code]);

                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
                $userdata = $provider->getUserData($user);

                $userdata_event = $this->grav->fireEvent('onOAuth2Userdata', new Event(['userdata'=>$userdata, 'oauth2user'=>$user, 'provider'=>$provider, 'token'=>$token]));
                // Set again with any event-based modifications
                $userdata = $userdata_event['userdata'];

                // Get username from an event to allow you to modify oauth2 filename
                $username_event = $this->grav->fireEvent('onOAuth2Username', new Event(['userdata'=>$userdata, 'oauth2user'=>$user, 'provider'=>$provider, 'token'=>$token]));

                $username = $username_event['username'];
                $grav_user = User::load($username);

                // Add token to user
                $grav_user->set('token', json_encode($token));

                // Set provider
                $grav_user->set('provider', $provider_name);

                // Default Access levels
                $current_access = $grav_user->get('access');
                if (!$current_access) {
                    $access = $this->config->get('plugins.login-oauth2.default_access_levels.access', []);
                    if (count($access) > 0) {
                        $data['access'] = $access;
                        $grav_user->merge($data);
                    }
                }

                // Default Groups
                $current_groups = $grav_user->get('groups');
                if (!$current_groups) {
                    $groups = $this->config->get('plugins.login-oauth2.default_groups', []);
                    if (count($groups) > 0) {
                        $data['groups'] = $groups;
                        $grav_user->merge($data);
                    }
                }

                // Remove Provider Userdata if configured
                if (!$this->config->get('plugins.login-oauth2.store_provider_data', false)) {
                    unset($userdata[$provider_name]);
                }

                $grav_user->merge($userdata);

                // Save Grav user if so configured
                if ($this->config->get('plugins.login-oauth2.save_grav_user', false)) {
                    $grav_user->save();
                }

                $event->setUser($grav_user);

                // Do something...
                $event->setStatus($event::AUTHENTICATION_SUCCESS);
                $event->stopPropagation();
            } catch (\Exception $e) {
                $event->setMessage('OAuth2 ' . ucfirst($provider_name) . ' Login Failed: ' . $e->getMessage(), 'error');
                $event->setStatus($event::AUTHENTICATION_FAILURE);
            }
        }
    }

    public function onOAuth2Username(Event $event)
    {
        $userdata = $event['userdata'];
        $provider = $event['provider'];
        $provider_name = strtolower($provider->getName());

        $username_parts = [$provider_name, $userdata['id'], $userdata['login']];
        $event['username'] = implode('.', $username_parts);

        $event->stopPropagation();
    }

    public function userLoginFailure(UserLoginEvent $event)
    {
        // This gets fired if user fails to log in.
    }

    public function userLogin(UserLoginEvent $event)
    {

    }

    public function userLogout(UserLoginEvent $event)
    {
        // This gets fired on user logout.
    }
}
