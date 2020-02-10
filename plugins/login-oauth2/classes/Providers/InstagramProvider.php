<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Instagram;

class InstagramProvider extends BaseProvider
{
    protected $name = 'Instagram';
    protected $classname = 'League\\OAuth2\\Client\\Provider\\Instagram';

    public function initProvider(array $options)
    {
        $options += [
            'clientId'      => $this->config->get('providers.instagram.client_id'),
            'clientSecret'  => $this->config->get('providers.instagram.client_secret'),
            'host'          => $this->config->get('providers.instagram.options.host')
        ];

        parent::initProvider($options);
    }

    public function getAuthorizationUrl()
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.instagram.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    public function getUserData($user)
    {
        $data_user = [
            'id'         => $user->getId(),
            'login'      => $user->getNickname(),
            'fullname'   => $user->getName(),
            'instagram'  => [
                'avatar_url' => $user->getImageurl(),
            ]
        ];

        return $data_user;
    }
}