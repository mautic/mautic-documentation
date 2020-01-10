<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Data\Data;
use Grav\Common\Grav;
use Grav\Common\Utils;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

abstract class BaseProvider implements ProviderInterface
{
    const CALLBACK_URI = '/task:callback.oauth2';

    /** @var string */
    protected $name;
    /** @var string */
    protected $classname;
    /** @var AbstractProvider */
    protected $provider;
    /** @var string */
    protected $state;
    /** @var stdClass */
    protected $token;

    protected $config;

    /**
     * BaseProvider constructor.
     */
    public function __construct()
    {
        $admin = Grav::instance()['oauth2']->isAdmin();
        $this->config = new Data(Grav::instance()['config']->get('plugins.login-oauth2' . ($admin ? '.admin' : '')));
        $this->state = 'LOGIN_OAUTH2_' . Utils::generateRandomString(15);
    }

    /**
     * Initialize Provider
     *
     * @param array $options
     */
    public function initProvider(array $options)
    {
        $options['redirectUri'] = $this->getCallbackUri();
        $this->provider = new $this->classname($options);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return AbstractProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    public static function getCallbackUri($admin = 'auto')
    {
        if ($admin === 'auto') {
            $admin = Grav::instance()['oauth2']->isAdmin();
        }

        $callback_uri = ((bool) $admin ? Grav::instance()['config']->get('plugins.admin.route', '') : '') . static::CALLBACK_URI;

        $base_url = Grav::instance()['base_url_absolute'];

        return $base_url . '/' . ltrim($callback_uri, '/');
    }

    /**
     * Requests an access token using a specified grant and option set.
     *
     * @param  mixed $grant
     * @param  array $options
     * @return AccessToken
     */
    public function getAccessToken($grant, array $options = [])
    {
        $this->token = $this->provider->getAccessToken($grant, $options);
        return $this->token;
    }

    /**
     * Requests and returns the resource owner of given access token.
     *
     * @param  AccessToken $token
     * @return ResourceOwnerInterface
     */
    public function getResourceOwner(AccessToken $token)
    {
        return $this->provider->getResourceOwner($token);
    }
}