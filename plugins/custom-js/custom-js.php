<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class CustomJSPlugin
 * @package Grav\Plugin
 */
class CustomJSPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onAssetsInitialized' => ['onAssetsInitialized', 0]
        ]);
    }

    public function onAssetsInitialized()
    {
        $this->grav['assets']->addInlineJs($this->config->get('plugins.custom-js.js_inline'));

        foreach($this->config->get('plugins.custom-js.js_files', []) as $file) {
            if (trim($file['path']) !== '') {
                $options['priority'] = isset($file['priority']) ? $file['priority'] : null;
                $options['group'] = isset($file['group']) ? $file['group'] : 'head';
                $this->grav['assets']->addJs($file['path'], $options);
            }
        }
    }
}
