<?php
namespace Riskio\OAuth2\Client\Provider\Exception;

use RuntimeException;

class InvalidRegionException extends RuntimeException
{
    protected $message = 'Invalid region provided';
}
