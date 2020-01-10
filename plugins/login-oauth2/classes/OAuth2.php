<?php
namespace Grav\Plugin\Login\OAuth2;

use Grav\Common\Grav;

class OAuth2
{
    protected $config;
    protected $providers = [];
    protected $admin;

    public function __construct($admin = false)
    {
        $this->config = Grav::instance()['config']->get('plugins.login-oauth2');
        $this->admin = $admin;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function addEnabledProviders()
    {
        if ($this->admin) {
            $providers = isset($this->config['admin']['providers']) ? (array)$this->config['admin']['providers'] : [];
        } else {
            $providers = isset($this->config['providers']) ? (array)$this->config['providers'] : [];
        }

        foreach ($providers as $provider => $options) {
            if ($options['enabled']) {
                $this->addProvider($provider, $options);
            }
        }
    }

    public function addProvider($provider = null, $options = null)
    {
        $this->providers[$provider] = $options;
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function getProviderOptions($provider)
    {
        if (isset($this->providers[$provider])) {
            return $this->providers[$provider];
        } else {
            return null;
        }
    }

    public function isValidProvider($provider)
    {
        if (in_array($provider, array_keys($this->providers),true)) {
            return true;
        }
        return false;
    }
}