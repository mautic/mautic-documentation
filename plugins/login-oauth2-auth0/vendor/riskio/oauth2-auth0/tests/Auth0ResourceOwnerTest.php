<?php
namespace Riskio\OAuth2\Client\Test\Provider;

use PHPUnit\Framework\TestCase;
use Riskio\OAuth2\Client\Provider\Auth0ResourceOwner;

class Auth0ResourceOwnerTest extends TestCase
{
    public $response = [
        'email' => 'testuser@gmail.com',
        'email_verified' => true,
        'name' => 'Test User',
        'given_name' => 'Test',
        'family_name' => 'User',
        'picture' => 'https://lh5.googleusercontent.com/-NNasdfdfasdf/asfadfdf/photo.jpg',
        'gender' => 'male',
        'locale' => 'en-GB',
        'clientID' => 'U_DUMmyClientIdhere',
        'updated_at' => '2017-08-25T10:54:21.326Z',
        'user_id' => 'google-oauth2|11204527450454',
        'nickname' => ' testuser',
        'identities' => [
            [
                'provider' => 'google-oauth2',
                'user_id' => '11204527450454',
                'connection' => 'google-oauth2',
                'isSocial' => true,
            ],
        ],
        'created_at' => '2017-08-14T13:22:29.753Z',
        'sub' => 'google-oauth2|113974520365241488704',
    ];

    public function testGetUserDetails()
    {
        $user = new Auth0ResourceOwner($this->response);

        $this->assertEquals($this->response['name'], $user->getName());
        $this->assertEquals($this->response['user_id'], $user->getId());
        $this->assertEquals($this->response['email'], $user->getEmail());
        $this->assertEquals($this->response['identities'], $user->getIdentities());
        $this->assertEquals($this->response, $user->toArray());
    }
}
