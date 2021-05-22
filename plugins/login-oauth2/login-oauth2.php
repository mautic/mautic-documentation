<?php

namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Exception;
use Grav\Common\Debugger;
use Grav\Common\Language\Language;
use Grav\Common\Plugin;
use Grav\Common\Session;
use Grav\Common\User\Interfaces\UserCollectionInterface;
use Grav\Plugin\Login\Events\UserLoginEvent;
use Grav\Plugin\Login\Login;
use Grav\Plugin\Login\OAuth2\OAuth2;
use Grav\Plugin\Login\OAuth2\ProviderFactory;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\Session\Message;
use RuntimeException;

/**
 * Class GravPluginLoginOauth2Plugin
 * @package Grav\Plugin
 */
class LoginOauth2Plugin extends Plugin
{
    /** @var bool */
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
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                ['onPluginsInitialized', 0]
            ],
        ];
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onTwigLoader(): void
    {
        $media_paths = $this->grav['locator']->findResources('plugins://login-oauth2/media');
        foreach(array_reverse($media_paths) as $images_path) {
            $this->grav['twig']->addPath($images_path, 'oauth2-media');
        }
    }

    /**
     * [onTwigTemplatePaths] Add twig paths to plugin templates.
     */
    public function onTwigTemplatePaths(): void
    {
        $twig = $this->grav['twig'];
        $twig->twig_paths[] = __DIR__ . '/templates';
    }

    public function onTwigSiteVariables(): void
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
    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            if (!$this->grav['config']->get('plugins.login-oauth2.admin.enabled')) {
                // Don't proceed if we are in the admin plugin
                return;
            }
            $this->admin = true;
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
            throw new RuntimeException('The Login plugin needs to be installed and enabled');
        }


        $isAdmin = $this->admin;
        $this->grav['oauth2'] = static function () use ($isAdmin) {
            // Add OAuth2 object to Grav
            $oauth2 = new OAuth2($isAdmin);
            $oauth2->addEnabledProviders();

            return $oauth2;
        };
    }

    /**
     * Add navigation item to the admin plugin
     */
    public function onLoginPage(): void
    {
        if ($this->grav['oauth2']->getProviders()) {
            $this->grav['login']->addProviderLoginTemplate('login-oauth2/login-oauth2.html.twig');
        }
    }

    /**
     * Task: login.oauth2
     */
    public function loginRedirect(): void
    {
        /** @var OAuth2 $oauth2 */
        $oauth2 = $this->grav['oauth2'];

        $user = $this->grav['user'] ?? null;
        if ($user && $user->authorized) {
            throw new RuntimeException('You have already been logged in', 403);
        }

        $provider_name = filter_input(INPUT_POST,'oauth2',FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if (!isset($provider_name)) {
            throw new RuntimeException('Bad Request', 400);
        }

        if ($oauth2->isValidProvider($provider_name)) {

            $provider = ProviderFactory::create($provider_name);

            /** @var Session $session */
            $session = $this->grav['session'];
            $session->oauth2_state = $provider->getState();
            $session->oauth2_provider = $provider_name;
            if ($this->isAdmin()) {
                $current = (string)$this->grav['admin']->request->getUri();
                $session->redirect_after_login = $current;
            }

            $authorizationUrl = $provider->getAuthorizationUrl();

            $this->grav->redirect($authorizationUrl);
        }
    }

    /**
     * Task: callback.oauth2
     */
    public function loginCallback(): void
    {
        /** @var Login $login */
        $login = $this->grav['login'];

        /** @var OAuth2 $oauth2 */
        $oauth2 = $this->grav['oauth2'];

        /** @var Session $session */
        $session = $this->grav['session'];
        $provider_name = $session->oauth2_provider;
        $login_redirect = $session->redirect_after_login;

        /** @var Language $t */
        $t = $this->grav['language'];
        /** @var Message $messages */
        $messages = $this->grav['messages'];

        if ($provider_name && $oauth2->isValidProvider($provider_name)) {
            $state = filter_input(INPUT_GET, 'state', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            if (empty($state)) {
                $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            }

            if (empty($state) || ($state !== $session->oauth2_state)) {
                unset($session->oauth2_state);
                // TODO: better error message?
                $messages->add($t->translate('PLUGIN_LOGIN.LOGIN_FAILED'), 'error');
            } else {
                // Fire Login process.
                $event = $login->login(
                    [],
                    ['admin' => $this->isAdmin(), 'remember_me' => true, 'oauth2' => true, 'provider' => $provider_name],
                    ['authorize' => $this->isAdmin() ? 'admin.login' : 'site.login', 'return_event' => true]);

                // Note: session variables have been reset!
                $user = $event->getUser();
                if ($user->authorized) {
                    $event->defMessage('PLUGIN_LOGIN.LOGIN_SUCCESSFUL', 'info');

                    if ($this->isAdmin()) {
                        $event->defRedirect($login_redirect ?? '/');
                    } else {
                        $event->defRedirect(
                            $login_redirect
                                ?: LoginPlugin::defaultRedirectAfterLogin()
                                ?: $this->grav['uri']->referrer('/')
                        );
                    }
                } elseif ($user->authenticated) {
                    $event->defMessage('PLUGIN_LOGIN.ACCESS_DENIED', 'error');

                    if ($this->isAdmin()) {
                        $event->defRedirect($login_redirect ?? '/');
                    } else {
                        $event->defRedirect($this->grav['config']->get('plugins.login.route_unauthorized', '/'));
                    }
                } else {
                    $event->defMessage('PLUGIN_LOGIN.LOGIN_FAILED', 'error');

                    if ($this->isAdmin()) {
                        $event->defRedirect($login_redirect ?? '/');
                    } else {
                        $event->defRedirect($this->grav['config']->get('plugins.login.route', '/'));
                    }
                }

                $message = $event->getMessage();
                if ($message) {
                    /** @var Debugger $debugger */
                    $debugger = $this->grav['debugger'];
                    $debugger->addMessage($t->translate($message), 'debug');

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

    public function userLoginAuthenticate(UserLoginEvent $event): void
    {
        // Second parameter of Login::login() call.
        $options = $event->getOptions();

        if (isset($options['oauth2'])) {
            $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            if (!$code) {
                $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            }

            $provider_name = $options['provider'];

            $provider = ProviderFactory::create($provider_name, $options);

            try {
                // Try to get an access token (using the authorization code grant)
                $token = $provider->getAccessToken('authorization_code', ['code' => $code]);

                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
                $userdata = $provider->getUserData($user);

                $userdata_event = new Event(
                    [
                        'userdata' => $userdata,
                        'oauth2user' => $user,
                        'provider' => $provider,
                        'token' => $token
                    ]
                );
                $this->grav->fireEvent('onOAuth2Userdata', $userdata_event);
                // Set again with any event-based modifications
                $userdata = $userdata_event['userdata'];

                $username_event = new Event(
                    [
                        'userdata' => $userdata,
                        'oauth2user' => $user,
                        'provider' => $provider,
                        'token' => $token
                    ]
                );
                // Get username from an event to allow you to modify oauth2 filename
                $this->grav->fireEvent('onOAuth2Username', $username_event);

                $username = $username_event['username'];

                /** @var UserCollectionInterface $accounts */
                $accounts = $this->grav['accounts'];
                $grav_user = $accounts->load($username);

                // If username cannot be found, fall back to email address.
                $exists = $grav_user->exists();
                if (!$exists) {
                    $found_user = $accounts->find($userdata['email'], ['email']);
                    if ($found_user->exists()) {
                        $grav_user = $found_user;
                        $exists = true;
                    }
                }

                // Make sure we're using the same provider, multiple providers are not supported.
                if ($exists) {
                    $provider_test = $grav_user->get('provider');
                    if ($provider_test && $provider_test !== $provider_name) {
                        throw new RuntimeException($this->translate('PLUGIN_LOGIN_OAUTH2.ERROR_EXISTING_ACCOUNT', $provider_test));
                    }
                }

                if ($this->config->get('plugins.login-oauth2.require_grav_user', false) && !$exists) {
                    throw new RuntimeException($this->translate('PLUGIN_LOGIN_OAUTH2.ERROR_NO_ACCOUNT', $username));
                }

                // Add token to user
                $grav_user->set('token', json_encode($token, JSON_THROW_ON_ERROR));

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
            } catch (Exception $e) {
                $event->setMessage($this->translate('PLUGIN_LOGIN_OAUTH2.OAUTH2_LOGIN_FAILED', ucfirst($provider_name), $e->getMessage()), 'error');
                $event->setStatus($event::AUTHENTICATION_FAILURE);
            }
        }
    }

    public function onOAuth2Username(Event $event): void
    {
        $userdata = $event['userdata'];
        $provider = $event['provider'];
        $provider_name = strtolower($provider->getName());

        $username_parts = [$provider_name, $userdata['id'], $userdata['login']];
        $username = implode('.', $username_parts);

        $event['username'] = $username;

        $event->stopPropagation();
    }

    public function userLoginFailure(UserLoginEvent $event): void
    {
        // This gets fired if user fails to log in.
    }

    public function userLogin(UserLoginEvent $event): void
    {

    }

    public function userLogout(UserLoginEvent $event): void
    {
        // This gets fired on user logout.
    }

    /**
     * @param mixed ...$args
     * @return string
     */
    private function translate(...$args): string
    {
        /** @var Language $language */
        $language = $this->grav['language'];

        return $language->translate($args);
    }
}
