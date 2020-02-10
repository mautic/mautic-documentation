<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Facebook;

class FacebookProvider extends BaseProvider
{
    protected $name = 'Facebook';
    protected $classname = 'League\\OAuth2\\Client\\Provider\\Facebook';
    protected $config;

    public function initProvider(array $options)
    {
        $options += [
            'clientId'          => $this->config->get('providers.facebook.app_id'),
            'clientSecret'      => $this->config->get('providers.facebook.app_secret'),
            'graphApiVersion'   => $this->config->get('providers.facebook.options.graph_api_version')
        ];

        parent::initProvider($options);
    }

    public function getAuthorizationUrl()
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.facebook.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    public function getUserData($user)
    {
        $data_user = [
            'id'         => $user->getId(),
            'login'      => $user->getEmail(),
            'fullname'   => $user->getName(),
            'email'      => $user->getEmail(),
            'facebook'  => [
                'avatar_url' => $user->getPictureUrl(),
                'location' => $user->getHometown() ? $user->getHometown()['name'] : ''
            ]
        ];

        return $data_user;
    }
}