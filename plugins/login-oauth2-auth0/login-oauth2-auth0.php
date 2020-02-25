<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class LoginOAuth2Auth0Plugin
 * @package Grav\Plugin
 */
class LoginOAuth2Auth0Plugin extends Plugin
{
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
            'onPluginsInitialized' => [
                ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ],
            'onTwigLoader'              => ['onTwigLoader', 0],
            'onTwigSiteVariables'       => ['onTwigSiteVariables', 0],
            'onTwigTemplatePaths'       => ['onTwigTemplatePaths', 0],
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        if (isset($this->grav['oauth2'])) {
            $this->grav['oauth2']->addProvider('auth0');
        } else {
            $this->grav['messages']->add('oauth2-auth0 plugin requires oauth2 plugin but it appears to not be installed or enabled', 'error');
        }
        
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload()
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onTwigLoader()
    {
        $media_paths = $this->grav['locator']->findResources('plugins://login-oauth2-auth0/media');
        foreach(array_reverse($media_paths) as $images_path) {
            $this->grav['twig']->addPath($images_path, 'oauth2-media');
        }
    }

    /**
     * [onTwigTemplatePaths] Add twig paths to plugin templates.
     */
    public function onTwigTemplatePaths()
    {
        $twig = $this->grav['twig'];
        $twig->twig_paths[] = __DIR__ . '/templates';
    }

    public function onTwigSiteVariables()
    {
        // add CSS for frontend if required
        if (!$this->isAdmin()) {
            $this->grav['assets']->add('plugin://login-oauth2-auth0/css/login-oauth2-auth0.css');
        }
    }
}
