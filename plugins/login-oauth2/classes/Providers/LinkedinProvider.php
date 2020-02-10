<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\LinkedIn;

class LinkedInProvider extends BaseProvider
{
    protected $name = 'LinkedIn';
    protected $classname = 'League\\OAuth2\\Client\\Provider\\LinkedIn';

    public function initProvider(array $options)
    {
        $options += [
            'clientId'      => $this->config->get('providers.linkedin.client_id'),
            'clientSecret'  => $this->config->get('providers.linkedin.client_secret'),
        ];

        parent::initProvider($options);
    }

    public function getAuthorizationUrl()
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.linkedin.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    public function getUserData($user)
    {
        $data_user = [
            'id'         => $user->getId(),
            'login'      => $user->getEmail(),
            'fullname'   => $user->getFirstName() . ' ' . $user->getLastName(),
            'email'      => $user->getEmail(),
            'linkedin'  => [
                'avatar_url' => $user->getImageurl(),
                'headline' => $user->getDescription(),
                'location' => $user->getLocation(),
            ]
        ];

        return $data_user;
    }
}