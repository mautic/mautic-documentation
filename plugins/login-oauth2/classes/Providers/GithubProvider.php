<?php

namespace Grav\Plugin\Login\OAuth2\Providers;

use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\GithubResourceOwner;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class GithubProvider extends BaseProvider
{
    /** @var string */
    protected $name = 'Github';
    /** @var string */
    protected $classname = Github::class;

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
            'clientId'      => $this->config->get('providers.github.client_id'),
            'clientSecret'  => $this->config->get('providers.github.client_secret'),
        ];

        parent::initProvider($options);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.github.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @param ResourceOwnerInterface|GithubResourceOwner $user
     * @return array
     */
    public function getUserData(ResourceOwnerInterface $user): array
    {
        \assert($user instanceof GithubResourceOwner);

        $data = $user->toArray();

        return [
            'id'         => $user->getId(),
            'login'      => $data['login'],
            'fullname'   => $user->getName(),
            'email'      => $this->getEmail($user),
            'github'     => [
                'location'   => $data['location'],
                'company'    => $data['company'],
                'avatar_url' => $data['avatar_url'],
            ]
        ];
    }

    /**
     * Handle regular email
     *
     * @param ResourceOwnerInterface|GithubResourceOwner $user
     * @return string|null
     */
    public function getEmail(ResourceOwnerInterface $user)
    {
        \assert($user instanceof GithubResourceOwner);

        $email = $user->getEmail();

        if (null === $email) {
            $url = $this->provider->getResourceOwnerDetailsUrl($this->token);
            $request = $this->provider->getAuthenticatedRequest(
                'GET',
                $url . '/emails',
                $this->token
            );

            $response = $this->provider->getResponse($request);
            $emails = json_decode($response->getBody()->getContents());

            $filtered = array_filter($emails, function($email) {
                return $email->primary && $email->verified;
            });

            $email = $filtered ? array_shift($filtered)->email : null;
        }

        return $email;
    }
}