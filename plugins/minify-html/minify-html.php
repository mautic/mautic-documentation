<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Class MinifyHtmlPlugin
 * @package Grav\Plugin
 */
class MinifyHtmlPlugin extends Plugin
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
      'onPluginsInitialized' => ['onPluginsInitialized', 0]
    ];
  }

  /**
   * Initialize the plugin
   */
  public function onPluginsInitialized()
  {
    // Don't proceed if we are in the admin plugin
    if ($this->isAdmin()) return;

    // Check if plugin is enabled
    if ($this->config['plugins.minify-html.enabled']) {

    // Enable the main event we are interested in
      $this->enable([
        'onOutputGenerated' => ['onOutputGenerated', 0]
      ]);
    }
  }

  /**
   * On Page Content Raw Hook
   */
  public function onOutputGenerated()
  {
    // Check if the page type is HTML
    if ($this->grav['page']->templateFormat() === 'html') {
      // If Minify HTML cache option is enabled and if page exist continue
      // Else only compress the page
      if ($this->config['plugins.minify-html.cache'] and !is_null($this->grav['page']->route())) {
        $cache = $this->grav['cache'];
        $cache_id = md5('minify-html' . $this->grav['page']->id());
        $compressedHtmlCache = $cache->fetch($cache_id);
        // If the page is not already cached compress the output then cache it
        // Else return the precached page
        if ($compressedHtmlCache === false) {
          $compressedHtml = $this->compressHtml();
          $cache->save($cache_id, $compressedHtml);
        } else {
          $compressedHtml = $compressedHtmlCache;
        }
      } else {
        $compressedHtml = $this->compressHtml();
      }

      // Return the compressed HTML
      $this->grav->output = $compressedHtml;
    }
  }

  /**
   * Compress HTML output
   *
   * @return string HTML output compressed
   */
  private function compressHtml()
  {
    require_once(__DIR__ . '/vendor/autoload.php');

    // HTML input (not compressed)
    $sourceHtml = $this->grav->output;

    // Compression mode
    $mode = $this->config['plugins.minify-html.mode'];

    // Instantiate the compressor
    if ($mode == 'default') $compressor = Factory::construct();
    elseif ($mode == 'fastest') $compressor = Factory::constructFastest();
    elseif ($mode == 'smallest') $compressor = Factory::constructSmallest();

    // HTML output (compressed)
    return $compressor->compress($sourceHtml);
  }
}
