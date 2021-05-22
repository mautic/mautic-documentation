<?php

namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Data\Data;
use Grav\Common\Grav;
use Grav\Common\Utils;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

abstract class BaseProvider implements ProviderInterface
{
    /** @var string */
    const CALLBACK_URI = '/task:callback.oauth2';

    /** @var string */
    protected $name;
    /** @var string */
    protected $classname;
    /** @var AbstractProvider */
    protected $provider;
    /** @var string */
    protected $state;
    /** @var AccessTokenInterface */
    protected $token;
    /** @var Data */
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
    public function initProvider(array $options): void
    {
        $options['redirectUri'] = self::getCallbackUri();
        $this->provider = new $this->classname($options);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return AbstractProvider
     */
    public function getProvider(): AbstractProvider
    {
        return $this->provider;
    }

    /**
     * @param string $admin
     * @return string
     */
    public static function getCallbackUri(string $admin = 'auto'): string
    {
        if ($admin === 'auto') {
            $admin = Grav::instance()['oauth2']->isAdmin();
        }

        $callback_uri = ($admin ? Grav::instance()['config']->get('plugins.admin.route', '') : '') . static::CALLBACK_URI;

        $base_url = rtrim(Grav::instance()['uri']->rootUrl(true), '/');

        return $base_url . '/' . ltrim($callback_uri, '/');
    }

    /**
     * Requests an access token using a specified grant and option set.
     *
     * @param mixed $grant
     * @param array $options
     * @return AccessTokenInterface
     * @throws IdentityProviderException
     */
    public function getAccessToken($grant, array $options = []): AccessTokenInterface
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
    public function getResourceOwner(AccessToken $token): ResourceOwnerInterface
    {
        return $this->provider->getResourceOwner($token);
    }
}
