<?php

namespace Grav\Plugin\Login\OAuth2\Providers;

use League\OAuth2\Client\Provider\LinkedIn;
use League\OAuth2\Client\Provider\LinkedInResourceOwner;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class LinkedinProvider extends BaseProvider
{
    /** @var string */
    protected $name = 'LinkedIn';
    /** @var string */
    protected $classname = LinkedIn::class;

    /**
     * @param array $options
     * @return bool
     */
    public static function checkIfActive(array $options): bool
    {
        $client_id = $options['client_id'] ?? false;

        return $client_id && parent::checkIfActive($options);
    }

    /**
     * @param array $options
     */
    public function initProvider(array $options): void
    {
        $options += [
            'clientId'      => $this->config->get('providers.linkedin.client_id'),
            'clientSecret'  => $this->config->get('providers.linkedin.client_secret'),
        ];

        parent::initProvider($options);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.linkedin.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @param ResourceOwnerInterface|LinkedInResourceOwner $user
     * @return array
     */
    public function getUserData(ResourceOwnerInterface $user): array
    {
        \assert($user instanceof LinkedInResourceOwner);

        return [
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
    }
}