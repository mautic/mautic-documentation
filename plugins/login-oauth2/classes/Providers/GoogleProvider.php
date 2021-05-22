<?php

namespace Grav\Plugin\Login\OAuth2\Providers;

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\GoogleUser;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class GoogleProvider extends BaseProvider
{
    /** @var string */
    protected $name = 'Google';
    /** @var string */
    protected $classname = Google::class;

    /**
     * @param array $options
     */
    public function initProvider(array $options): void
    {
        $options += [
            'clientId'      => $this->config->get('providers.google.client_id'),
            'clientSecret'  => $this->config->get('providers.google.client_secret'),
        ];
        $hd = $this->config->get('providers.google.options.hd');
        if ($hd) {
            $options['hostedDomain'] = $this->config->get('providers.google.options.hd');
        }

        parent::initProvider($options);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.google.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @param ResourceOwnerInterface|GoogleUser $user
     * @return array
     */
    public function getUserData(ResourceOwnerInterface $user): array
    {
        \assert($user instanceof GoogleUser);

        return [
            'id'         => $user->getId(),
            'login'      => $user->getEmail(),
            'fullname'   => $user->getName(),
            'email'      => $user->getEmail(),
            'google'  => [
                'avatar_url' => $this->getAvatar($user),
            ]
        ];
    }

    /**
     * @param ResourceOwnerInterface|GoogleUser $user
     * @return string
     */
    public function getAvatar(ResourceOwnerInterface $user): string
    {
        \assert($user instanceof GoogleUser);

        $avatar = $user->getAvatar() ?? '';
        if ($avatar) {
            $avatarSize = (int)$this->config->get('plugins.login-oauth2.providers.google.options.avatar_size', 200);
            $avatar = preg_replace("/\?sz=\d{1,}$/", '?sz=' . $avatarSize, $avatar);
        }

        return $avatar;
    }
}