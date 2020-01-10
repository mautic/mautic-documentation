<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Github;

class GithubProvider extends BaseProvider
{
    protected $name = 'Github';
    protected $classname = 'League\\OAuth2\\Client\\Provider\\Github';

    public function initProvider(array $options)
    {
        $options += [
            'clientId'      => $this->config->get('providers.github.client_id'),
            'clientSecret'  => $this->config->get('providers.github.client_secret'),
        ];

        parent::initProvider($options);
    }

    public function getAuthorizationUrl()
    {
        $options = ['state' => $this->state];
        $options['scope'] = $this->config->get('providers.github.options.scope');

        return $this->provider->getAuthorizationUrl($options);
    }

    public function getUserData($user)
    {
        $data = $user->toArray();

        $data_user = [
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

        return $data_user;
    }

    /**
     * Handle regular email
     *
     * @param $user
     * @return null
     */
    public function getEmail($user)
    {
        $email = $user->getEmail();

        if (is_null($email)) {
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