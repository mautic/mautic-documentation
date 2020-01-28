<?php
namespace Grav\Plugin;

use Grav\Common\Language\LanguageCodes;
use Grav\Common\Page\Page;
use \Grav\Common\Plugin;

class LanguageSelectorPlugin extends Plugin
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
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $this->enable([
            'onTwigInitialized'   => ['onTwigInitialized', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }

    /** Add the native_name function */
    public function onTwigInitialized()
    {
        $this->grav['twig']->twig()->addFunction(
            new \Twig_SimpleFunction('native_name', function($key) {
                return LanguageCodes::getNativeName($key);
            })
        );
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Set needed variables to display Language-Selector.
     */
    public function onTwigSiteVariables()
    {
        $data = new \stdClass;

        // Manage Data content
        $page = $this->grav['page'];
        $data->page_route = $page->rawRoute();
        if ($page->home()) {
            $data->page_route = '/';
        }

        $languages = $this->grav['language']->getLanguages();
        $data->languages = $languages;

        if ($this->config->get('plugins.language-selector.untranslated_pages_behavior') !== 'none') {
            $translated_pages = [];
            foreach ($languages as $language) {
                $translated_pages[$language] = null;
                $page_name_without_ext = substr($page->name(), 0, -(strlen($page->extension())));
                $translated_page_path = $page->path() . DS . $page_name_without_ext . '.' . $language . '.md';
                if (file_exists($translated_page_path)) {
                    $translated_page = new Page();
                    $translated_page->init(new \SplFileInfo($translated_page_path), $language . '.md');
                    $translated_pages[$language] = $translated_page;
                }
            }
            $data->translated_pages = $translated_pages;
        }

        $data->current = $this->grav['language']->getLanguage();

        // Manage Twig Variables
        $path_flags = $this->grav['locator']->findResource('plugin://language-selector/flags/', false) . "/";
        $path_flags = $this->grav['base_url'] ."/". ltrim($path_flags, '/');
        $this->grav['twig']->twig_vars['language_selector'] = $data;
        $this->grav['twig']->twig_vars['language_display'] = array(
            "select" => $this->config->get('plugins.language-selector.select_display'),
            "button" => $this->config->get('plugins.language-selector.button_display'),
        );
        $this->grav['twig']->twig_vars['path_flags'] = $path_flags;

        // Manage Assets
        $this->grav['assets']->add('plugin://language-selector/js/language-selector.js');
        if ($this->config->get('plugins.language-selector.built_in_css')) {
          $this->grav['assets']->add('plugin://language-selector/css/language-selector.css');
        }
    }

    public function getNativeName($code) {

    }
}
