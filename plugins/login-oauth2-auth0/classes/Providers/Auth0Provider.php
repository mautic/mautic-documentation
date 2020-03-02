<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use Riskio\OAuth2\Client\Provider\Auth0;

class Auth0Provider extends BaseProvider
{
    protected $name = 'Auth0';
    protected $classname = 'Riskio\\OAuth2\\Client\\Provider\\Auth0';

    public function initProvider(array $options)
    {
        $this->config = Grav::instance()['config'];
        $options += [
            'clientId' => $this->config->get('plugins.login-oauth2-auth0.client_id'),
            'clientSecret' => $this->config->get('plugins.login-oauth2-auth0.client_secret'),
            'customDomain' => $this->config->get('plugins.login-oauth2-auth0.domain'),
        ];

        parent::initProvider($options);
    }

    public function getAuthorizationUrl()
    {
        $this->config = Grav::instance()['config'];
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('plugins.login-oauth2-auth0.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    public function getUserData($user)
    {
        $data = $user->toArray();

        $data_user = [
            'id' => $user->getId(),
            'login' => $user->getEmail(),
            'fullname' => $user->getNickname(),
            'email' => $user->getEmail(),
        ];

        return $data_user;
    }
}
