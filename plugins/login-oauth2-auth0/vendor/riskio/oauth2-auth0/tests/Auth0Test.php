<?php
namespace Riskio\OAuth2\Client\Test\Provider;

use League\OAuth2\Client\Token\AccessToken;
use PHPUnit\Framework\TestCase;
use Riskio\OAuth2\Client\Provider\Auth0 as OauthProvider;
use RuntimeException;

class Auth0Test extends TestCase
{
    const DEFAULT_ACCOUNT = 'mock_account';

    protected $config = [
        'account'      => self::DEFAULT_ACCOUNT,
        'clientId'     => 'mock_client_id',
        'clientSecret' => 'mock_secret',
        'redirectUri'  => 'none',
    ];

    /**
     * @dataProvider regionDataProvider
     */
    public function testGetAuthorizationUrl($region, $expectedHost)
    {
        $provider = new OauthProvider(array_merge($this->config, ['region' => $region]));
        $url = $provider->getAuthorizationUrl();
        $parsedUrl = parse_url($url);

        $this->assertEquals($expectedHost, $parsedUrl['host']);
        $this->assertEquals('/authorize', $parsedUrl['path']);
    }

    public function testGetAuthorizationUrlWhenAccountIsNotSpecifiedShouldThrowException()
    {
        unset($this->config['account']);

        $provider = new OauthProvider($this->config);

        $this->expectException(RuntimeException::class);
        $provider->getAuthorizationUrl();
    }

    /**
     * @dataProvider regionDataProvider
     */
    public function testGetUrlAccessToken($region, $expectedHost)
    {
        $provider = new OauthProvider(array_merge($this->config, ['region' => $region]));
        $url = $provider->getBaseAccessTokenUrl();
        $parsedUrl = parse_url($url);

        $this->assertEquals($expectedHost, $parsedUrl['host']);
        $this->assertEquals('/oauth/token', $parsedUrl['path']);
    }

    public function testGetAccessTokenUrlWhenAccountIsNotSpecifiedShouldThrowException()
    {
        unset($this->config['account']);

        $provider = new OauthProvider($this->config);

        $this->expectException(RuntimeException::class);
        $provider->getBaseAccessTokenUrl();
    }

    /**
     * @dataProvider regionDataProvider
     */
    public function testGetUrlUserDetails($region, $expectedHost)
    {
        $provider = new OauthProvider(array_merge($this->config, ['region' => $region]));

        $accessTokenDummy = $this->getAccessToken();

        $url = $provider->getResourceOwnerDetailsUrl($accessTokenDummy);
        $parsedUrl = parse_url($url);

        $this->assertEquals($expectedHost, $parsedUrl['host']);
        $this->assertEquals('/userinfo', $parsedUrl['path']);
    }

    /**
     * @expectedException \Riskio\OAuth2\Client\Provider\Exception\AccountNotProvidedException
     */
    public function testGetUserDetailsUrlWhenAccountIsNotSpecifiedShouldThrowException()
    {
        unset($this->config['account']);

        $provider = new OauthProvider($this->config);

        $accessTokenDummy = $this->getAccessToken();
        $provider->getResourceOwner($accessTokenDummy);
    }

    /**
     * @expectedException \Riskio\OAuth2\Client\Provider\Exception\InvalidRegionException
     */
    public function testGetUserDetailsUrlWhenInvalidRegionIsProvidedShouldThrowException()
    {
        $this->config['region'] = 'invalid_region';

        $provider = new OauthProvider($this->config);

        $accessTokenDummy = $this->getAccessToken();
        $provider->getResourceOwner($accessTokenDummy);
    }

    public function regionDataProvider()
    {
        return [
            [
                OauthProvider::REGION_US,
                sprintf('%s.auth0.com', self::DEFAULT_ACCOUNT),
            ],
            [
                OauthProvider::REGION_EU,
                sprintf('%s.%s.auth0.com', self::DEFAULT_ACCOUNT, OauthProvider::REGION_EU),
            ],
            [
                OauthProvider::REGION_AU,
                sprintf('%s.%s.auth0.com', self::DEFAULT_ACCOUNT, OauthProvider::REGION_AU),
            ],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|AccessToken
     */
    private function getAccessToken()
    {
        return $this->getMockBuilder(AccessToken::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @dataProvider scopeDataProvider
     */
    public function testGetAuthorizationUrlWithScopes($scopes, $expectedScopeParameter)
    {
        $provider = new OauthProvider(array_merge($this->config, ['scope' => $scopes]));

        $url = $provider->getAuthorizationUrl();
        $queryString = parse_url($url, PHP_URL_QUERY);

        $this->assertContains($expectedScopeParameter, $queryString);
    }

    public function scopeDataProvider()
    {
        return [
            [['openid'], 'scope=openid'],
            [['openid', 'email'], 'scope=openid%20email'],
        ];
    }

    public function testGetAuthorizationUrlWithCustomDomain()
    {
        $customDomain = 'login.custom-domain.tld';
        $provider = new OauthProvider(array_merge($this->config, ['customDomain' => $customDomain]));
        $url = $provider->getAuthorizationUrl();
        $expectedBaseUrl = 'https://' . $customDomain;

        $this->assertStringStartsWith($expectedBaseUrl, $url);
    }

    /**
     * Test that URL getters work as expected with custom domain set, and account not set.
     * They should not throw AccountNotProvidedException (or any exception),
     * and have to return an url starting with the custom domain.
     */
    public function testCustomDomain()
    {
        $customDomain = 'login.custom-domain.tld';
        $this->config['customDomain'] = $customDomain;
        unset($this->config['account']);
        $expectedBaseUrl = 'https://' . $customDomain;

        $provider = new OauthProvider($this->config);
        $accessTokenDummy = $this->getAccessToken();

        $url = $provider->getBaseAuthorizationUrl();
        $this->assertStringStartsWith($expectedBaseUrl, $url);

        $url = $provider->getBaseAccessTokenUrl();
        $this->assertStringStartsWith($expectedBaseUrl, $url);

        $url = $provider->getResourceOwnerDetailsUrl($accessTokenDummy);
        $this->assertStringStartsWith($expectedBaseUrl, $url);
    }
}
