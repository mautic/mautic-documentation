<?php

namespace Grav\Plugin\Login\OAuth2\Providers;

use League\OAuth2\Client\Provider\Instagram;
use League\OAuth2\Client\Provider\InstagramResourceOwner;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class InstagramProvider extends BaseProvider
{
    /** @var string */
    protected $name = 'Instagram';
    /** @var string */
    protected $classname = Instagram::class;

    /**
     * @param array $options
     */
    public function initProvider(array $options): void
    {
        $options += [
            'clientId'      => $this->config->get('providers.instagram.client_id'),
            'clientSecret'  => $this->config->get('providers.instagram.client_secret'),
            'host'          => $this->config->get('providers.instagram.options.host')
        ];

        parent::initProvider($options);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.instagram.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @param ResourceOwnerInterface|InstagramResourceOwner $user
     * @return array
     */
    public function getUserData(ResourceOwnerInterface $user): array
    {
        \assert($user instanceof InstagramResourceOwner);

        return [
            'id'         => $user->getId(),
            'login'      => $user->getNickname(),
            'fullname'   => $user->getName(),
            'instagram'  => [
                'avatar_url' => $user->getImageurl(),
            ]
        ];
    }
}