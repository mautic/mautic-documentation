<?php

namespace Grav\Plugin\Login\OAuth2;

use Grav\Plugin\Login\OAuth2\Providers\ProviderInterface;

class ProviderFactory
{
    /**
     * @param string $provider
     * @param array $options
     * @return ProviderInterface
     */
    public static function create($provider, array $options = []): ProviderInterface
    {
        $provider_classname = 'Grav\\Plugin\\Login\\OAuth2\\Providers\\' . ucfirst($provider) . 'Provider';

        if (!class_exists($provider_classname)) {
            throw new \RuntimeException('Invalid OAuth2 provider');
        }

        $class = new $provider_classname();
        $class->initProvider($options);

        return $class;
    }
}