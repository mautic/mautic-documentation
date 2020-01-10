<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Google;

class GoogleProvider extends BaseProvider
{
    protected $name = 'Google';
    protected $classname = 'League\\OAuth2\\Client\\Provider\\Google';

    public function initProvider(array $options)
    {
        $options += [
            'clientId'      => $this->config->get('providers.google.client_id'),
            'clientSecret'  => $this->config->get('providers.google.client_secret'),
            'hostedDomain'  => $this->config->get('providers.google.options.hd', '*')
        ];

        parent::initProvider($options);
    }

    public function getAuthorizationUrl()
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.google.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    public function getUserData($user)
    {
        $data_user = [
            'id'         => $user->getId(),
            'login'      => $user->getEmail(),
            'fullname'   => $user->getName(),
            'email'      => $user->getEmail(),
            'google'  => [
                'avatar_url' => $this->getAvatar($user),
            ]
        ];

        return $data_user;
    }

    public function getAvatar($user)
    {
        $avatar = $user->getAvatar();
        $avatarSize = $this->config->get('plugins.login-oauth2.providers.google.options.avatar_size', 200);
        $avatar = preg_replace("/\?sz=\d{1,}$/", '?sz=' . $avatarSize, $avatar);

        return $avatar;
    }
}