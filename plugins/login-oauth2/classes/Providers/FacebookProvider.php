<?php

namespace Grav\Plugin\Login\OAuth2\Providers;

use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\FacebookUser;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class FacebookProvider extends BaseProvider
{
    /** @var string */
    protected $name = 'Facebook';
    /** @var string */
    protected $classname = Facebook::class;

    /**
     * @param array $options
     * @return bool
     */
    public static function checkIfActive(array $options): bool
    {
        $client_id = $options['app_id'] ?? false;

        return $client_id && parent::checkIfActive($options);
    }

    /**
     * @param array $options
     */
    public function initProvider(array $options): void
    {
        $options += [
            'clientId'          => $this->config->get('providers.facebook.app_id'),
            'clientSecret'      => $this->config->get('providers.facebook.app_secret'),
            'graphApiVersion'   => $this->config->get('providers.facebook.options.graph_api_version')
        ];

        parent::initProvider($options);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.facebook.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @param ResourceOwnerInterface|FacebookUser $user
     * @return array
     */
    public function getUserData(ResourceOwnerInterface $user): array
    {
        \assert($user instanceof FacebookUser);

        $hometown = $user->getHometown();

        return [
            'id'         => $user->getId(),
            'login'      => $user->getEmail(),
            'fullname'   => $user->getName(),
            'email'      => $user->getEmail(),
            'facebook'  => [
                'avatar_url' => $user->getPictureUrl(),
                'location' => $hometown ? $hometown['name'] : ''
            ]
        ];
    }
}