<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class SimpleCookiePlugin
 * @package Grav\Plugin
 */
class SimpleCookiePlugin extends Plugin
{
		/**
		 * Base assets path.
		 * @type string
		 */
		private $assetsPath = 'plugin://simple-cookie/assets/';

		/**
		 * Init cookie banner template.
		 * @type string
		 */
		private $initTemplate = 'partials/init-simple-cookie.html.twig';

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
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
						'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
						'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
		}

		/**
		 * Push plugin templates to twig paths array.
		 */
		public function onTwigTemplatePaths()
		{
				// Push own templates to twig paths
				array_push(
						$this->grav['twig']->twig_paths,
						__DIR__ . '/templates'
				);
		}

		/**
		 * Add plugin CSS and JS files to the grav assets.
		 */
		public function onTwigSiteVariables()
		{
				$twig = $this->grav['twig'];
				$assets = $this->grav['assets'];
				$pluginConfig = $this->config->toArray();

				// Add plugin files to the grav assets.
				$assets->addCss(
						$this->assetsPath . 'cookieconsent.min.css'
				);
				$assets->addJs(
						$this->assetsPath . 'cookieconsent.min.js'
				);

				// Add inline JS to initialize cookie banner.
				$assets->addInlineJs(
						$twig->twig->render(
									$this->initTemplate,
									['config' => $pluginConfig]
						)
				);
		}
}
