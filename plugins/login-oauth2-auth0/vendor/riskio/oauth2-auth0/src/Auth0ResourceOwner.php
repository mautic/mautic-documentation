<?php
namespace Riskio\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class Auth0ResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * @var array
     */
    protected $response;

    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getValueByKey($this->response, 'user_id');
    }

    /**
     * Returns email address of the resource owner
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getValueByKey($this->response, 'email');
    }

    /**
     * Returns full name of the resource owner
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getValueByKey($this->response, 'name');
    }

    /**
     * Returns nickname of the resource owner
     *
     * @return string|null
     */
    public function getNickname()
    {
        return $this->getValueByKey($this->response, 'nickname');
    }

    /**
     * Returns identities of the resource owner
     *
     * @see https://auth0.com/docs/user-profile/user-profile-structure
     * @return array|null
     */
    public function getIdentities()
    {
        return $this->getValueByKey($this->response, 'identities');
    }

    /**
     * Returns picture url of the resource owner
     *
     * @return string|null
     */
    public function getPictureUrl()
    {
        return $this->getValueByKey($this->response, 'picture');
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return $this->response;
    }
}
