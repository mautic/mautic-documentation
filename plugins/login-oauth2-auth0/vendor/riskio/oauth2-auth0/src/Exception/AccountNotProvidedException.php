<?php
namespace Riskio\OAuth2\Client\Provider\Exception;

use RuntimeException;

class AccountNotProvidedException extends RuntimeException
{
    protected $message = 'Auth0 account is not provided';
}
