<?php

namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Page;
use Grav\Common\Plugin;
use Grav\Common\User\User;

/**
 * Grav Plugin Grava11y
 * provides accessibility testing on your theme.
 *
 * @author Lawrence Meckan
 *
 * @link https://github.com/absalomedia/grav-plugin-grava11y
 *
 * @license http://opensource.org/licenses/MIT
 */
class Grava11yPlugin extends Plugin
{
    protected $enabled = false;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        // initialize when plugins are ready
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    /**
     * Initialize configuration.
     */
    public function onPluginsInitialized()
    {
        // Don't load in Admin-Backend
        if ($this->isAdmin()) {
            $this->active = false;

            return;
        }
        $this->initializeGrava11y();
    }

    /**
     * Initialize Grava11y
     * Check for user-auth and access before
     * loading JS file for a11y.
     */
    public function initializeGrava11y()
    {
        $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
        ]);
            // Save plugin status
        $this->enabled = true;
    }

    /**
     * if enabled on this page, load the JS.
     */
    public function onTwigSiteVariables()
    {
        // check if enabled
        if ($this->enabled) {
            $a11ystack = [
                    'plugin://grava11y/css/grava11y.css',
            ];

            $siter = $this->config->get('plugins.grava11y.offsite');
            $siter = (0) ? array_push($a11ystack, 'https://unpkg.com/@khanacademy/tota11y@0.2.0/dist/tota11y.min.js') :  array_push($a11ystack, 'plugin://grava11y/js/tota11y.min.js');
            // register and add assets
            $assets = $this->grav['assets'];
            $assets->registerCollection('grava11y', $a11ystack);
            $assets->add('grava11y', 100);
        }
    }
}
