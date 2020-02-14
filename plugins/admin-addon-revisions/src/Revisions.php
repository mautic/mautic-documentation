<?php
namespace AdminAddonRevisions;

use Grav\Common\Filesystem\Folder;
use AdminAddonRevisions\Util\Util;
use AdminAddonRevisions\Util\Diff;
use AdminAddonRevisions\Revision;
use Grav\Plugin\AdminAddonRevisionsPlugin;

class Revisions {

  protected $plugin;
  protected $page;
  protected $path;

  protected $instances = null;

  public function __construct($page) {
    $this->plugin = AdminAddonRevisionsPlugin::instance();
    $this->page = $page;

    $this->path = $page->path() . DS . $this->plugin->directoryName();
  }

  public function page() {
    return $this->page;
  }

  public function name() {
    return $this->name;
  }

  public function path() {
    return $this->path;
  }

  public function delete() {
    Folder::delete($this->path);
  }

  public function exists() {
    return file_exists($this->path) && is_dir($this->path);
  }

  public function create($mode = 0770) {
    mkdir($this->path, $mode);
  }

  public function directories() {
    return Util::scandirForDirectories($this->path);
  }

  public function count() {
    return count($this->directories());
  }

  public function instances($refresh = false) {
    if (!$refresh && $this->instances !== null) {
      return $this->instances;
    }

    $this->instances = [];
    $dirs = $this->directories();
    foreach ($dirs as $dir) {
      $this->instances[] = new Revision($this->page, $dir);
    }

    return $this->instances;
  }

  public function get($name) {
    return $this->instances()[$name];
  }

  public function first() {
    $instances = $this->instances();
    return reset($instances);
  }

  public function last() {
    $instances = $this->instances();
    return end($instances);
  }

}