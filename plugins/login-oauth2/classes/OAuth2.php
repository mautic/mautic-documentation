<?php

namespace Grav\Plugin\Login\OAuth2;

use Grav\Common\Grav;

class OAuth2
{
    /** @var array */
    protected $config;
    /** @var array */
    protected $providers = [];
    /** @var bool */
    protected $admin;

    /**
     * OAuth2 constructor.
     * @param bool $admin
     */
    public function __construct($admin = false)
    {
        $this->config = (array)(Grav::instance()['config']->get('plugins.login-oauth2') ?? []);
        $this->admin = (bool)$admin;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function addEnabledProviders(): void
    {
        if ($this->admin) {
            $providers = (array)($this->config['admin']['providers'] ?? []);
        } else {
            $providers = (array)($this->config['providers'] ?? []);
        }

        foreach ($providers as $provider => $options) {
            $enabled = $options['enabled'] ?? false;
            $client_id = $options['client_id'] ?? false;
            if ($enabled && $client_id) {
                $this->addProvider($provider, $options);
            }
        }
    }

    /**
     * @param string $provider
     * @param array|null $options
     */
    public function addProvider(string $provider, array $options = null): void
    {
        $this->providers[$provider] = $options;
    }

    public function getProviders(): array
    {
        return $this->providers;
    }

    /**
     * @param string $provider
     * @return mixed|null
     */
    public function getProviderOptions(string $provider)
    {
        return $this->providers[$provider] ?? null;
    }

    /**
     * @param string $provider
     * @return bool
     */
    public function isValidProvider(string $provider): bool
    {
        return array_key_exists($provider, $this->providers);
    }
}