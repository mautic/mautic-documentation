<?php
namespace Grav\Plugin;

use RocketTheme\Toolbox\Event\Event;
use Composer\Autoload\ClassLoader;

use Grav\Common\Plugin;

use AdminAddonRevisions\TaskHandler;
use AdminAddonRevisions\Revision;
use AdminAddonRevisions\Revisions;

class AdminAddonRevisionsPlugin extends Plugin {

  public static $instance;

  const SLUG = 'admin-addon-revisions';
  const PAGE_LOCATION = 'revisions';

  protected $directoryName;

  protected $loader = null;
  protected $taskHandler = null;

  public static function getSubscribedEvents() {
    return [
      'onPluginsInitialized' => ['onPluginsInitialized', 0]
    ];
  }

  public static function instance() {
    return self::$instance;
  }

  private function _autoload($namespace, $folders) {
    if ($this->loader === null) {
      $this->loader = new ClassLoader();
    }

    $this->loader->setPsr4($namespace . '\\', $folders);
    $this->loader->register(true);
  }

  public function configKey() {
    return 'plugins.' . self::SLUG;
  }

  public function onPluginsInitialized() {
    $this->_autoload('AdminAddonRevisions', array(__DIR__ . '/src/'));
    self::$instance = $this;

    $this->directoryName = $this->config->get($this->configKey() . '.directory', '.revs');

    // Add revisions directory to ignored folders
    $ignoreFolders = $this->config->get('system.pages.ignore_folders');
    if (!in_array($this->directoryName, $ignoreFolders)) {
      $ignoreFolders[] = $this->directoryName;
      $this->config->set('system.pages.ignore_folders', $ignoreFolders);
    }

    // Enable events
    $this->enable([
      'onPageProcessed' => ['onPageProcessed', 0],
      'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
      'onAdminTaskExecute' => ['onAdminTaskExecute', 0],
      'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
      'onAdminMenu' => ['onAdminMenu', 0],
      'onAssetsInitialized' => ['onAssetsInitialized', 0],
    ]);
  }

  public function onAssetsInitialized() {
    $this->grav['assets']->addCss('plugin://' . self::SLUG . '/assets/style.css');
  }

  public function onAdminMenu() {
    $twig = $this->grav['twig'];
    $twig->plugins_hooked_nav = (isset($twig->plugins_hooked_nav)) ? $twig->plugins_hooked_nav : [];
    $twig->plugins_hooked_nav['Revisions'] = [
      'location' => self::PAGE_LOCATION,
      'icon' => 'fa-file-text'
    ];
  }

  public function onAdminTwigTemplatePaths($e) {
    $paths = $e['paths'];
    $paths[] = __DIR__ . DS . 'templates';
    $e['paths'] = $paths;
  }

  public function onTwigSiteVariables() {
    $twig = $this->grav['twig'];
    $page = $this->grav['page'];
    $uri = $this->grav['uri'];

    if ($page->slug() !== self::PAGE_LOCATION) {
      return;
    }

    $action = $uri->param('action');
    $page = $this->getCurrentPage();
    $twig->twig_vars['context'] = $page;
    $pageDir = $page->path();
    $revDir = $pageDir . DS . $this->directoryName;

    if ($action === 'diff') {
      $rev = $uri->param('rev');
      $revision = new Revision($page, $rev);
      $changes = $revision->changes();
      foreach ($changes as $k => $v) {
        $twig->twig_vars[$k] = $v;
      }
      $twig->twig_vars['revision'] = $revision;
    } else {
      if ($uri->basename() === self::PAGE_LOCATION) {
        $action = 'list-pages';
        $pages = $this->grav['pages']->all();
        foreach ($pages as $k => $page) {
          // Remove folders
          if (!$page->file()) {
            unset($pages[$k]);
            continue;
          }

          $revisions = new Revisions($page);
          if ($revisions->exists()) {
            // Decrement by one, which is the current revision
            $page->revisions = $revisions->count() - 1;
            $page->lastRevision = $revisions->last()->createdAt();
          } else {
            $page->revisions = 0;
          }
        }
        $twig->twig_vars['revPages'] = $pages;
        $twig->twig_vars['context'] = null;
      } else {
        $action = 'list-revisions';
        $twig->twig_vars['revisions'] = new Revisions($page, $revDir);
      }
    }

    $twig->twig_vars['action'] = $action;
  }

  public function onAdminTaskExecute($e) {
    if ($this->taskHandler === null) {
      $this->taskHandler = new TaskHandler($this);
    }

    return $this->taskHandler->execute($e['method']);
  }

  public function onPageProcessed(Event $e) {
    $page = $e['page'];

    if (!$page->id() || !$page->exists()) {
      return;
    }

    $this->debugMessage('--- Admin Addon Revision - Analyzing \'' . $page->title(). '\' ---');

    $revisions = new Revisions($page);

    // Make sure we have a revisions directory
    if (!$revisions->exists()) {
      $this->debugMessage('-- Creating revision directory...');
      $revisions->create();
    }

    $changed = false;
    if ($revisions->count() == 0) {
      $this->debugMessage('-- No revisions found, save this one.');
      $changed = true;
    } else {
      $lastRev = $revisions->last();

      $changes = $lastRev->changesFast();

      if ($changes) {
        $changed = true;

        switch ($changes['type']) {
          case Revision::CHANGE_COUNT:
            $this->debugMessage('-- Number of files changed, save revision.');
            break;

          case Revision::CHANGE_NOT_EXISTS:
            $this->debugMessage('-- File ' . $changes['file'] . ' does not exist in the revision, save revision.');
            break;

          case Revision::CHANGE_CHANGED:
            $this->debugMessage('-- Content of ' . $changes['file'] . ' changed, save revision.');
            break;
        }
      }
    }

    if ($changed) {
      $this->debugMessage('-- Something changed, saving revision...');

      $revision = new Revision($page);

      $status = $revision->create();
      if (!$status) {
        $this->debugMessage('-- Revision directory exists, skipping...');
        return;
      }

      // Limit number of revisions
      $deletedRevision = false;
      do {
        $deletedRevision = false;

        // Check for maximum count and delete the oldest revisions first
        $maximum = $this->config->get($this->configKey() . '.limit.maximum', 0);
        if ($maximum && ctype_digit($maximum)) {
          // Refresh instances
          $revisions->instances(true);
          // Increment by one because we don't want to count the current revision
          if ($revisions->count() > $maximum + 1) {
            $firstRev = $revisions->first();
            $this->debugMessage('-- Deleting revision: ' . $firstRev->name() . ', limit exceeded.');
            $firstRev->delete();
            $deletedRevision = true;
          }
        }

        // Check for old revisions
        $older = $this->config->get($this->configKey() . '.limit.older', null);
        if ($older) {
          $instances = $revisions->instances(true);
          foreach ($revisions as $rev) {
            $time = $rev->createdAt();
            $olderTime = strtotime('-' . $older);
            if ($olderTime !== false && $older > $time) {
              $this->debugMessage('-- Deleting revision: ' . $rev->name() . ', older than ' . $older . '.');
              $rev->delete();
              $deletedRevision = true;
            }
          }
        }
      } while($deletedRevision);
    } else {
      $this->debugMessage('-- No changes.');
    }
  }

  private function debugMessage($msg) {
    $debugEnabled = $this->config->get($this->configKey() . '.debug');

    if ($debugEnabled) {
      $this->grav['debugger']->addMessage($msg);
    }
  }

  public function getCurrentPage() {
    $page = $this->grav['admin']->page(true);

    if (!$page) {
      $page = $this->grav['admin']->page();
    }

    return $page;
  }

  public function directoryName() {
    return $this->directoryName;
  }

  public function grav() {
    return $this->grav;
  }

  public function isIgnoredFile($file) {
    $patterns = $this->config->get($this->configKey() . '.ignore_files', []);

    foreach ($patterns as $pattern) {
      if (preg_match($pattern, $file)) {
        return true;
      }
    }

    return false;
  }

}