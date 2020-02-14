<?php
namespace AdminAddonRevisions;

use Grav\Common\Filesystem\Folder;
use AdminAddonRevisions\Util\Util;
use AdminAddonRevisions\Util\Diff;
use Grav\Plugin\AdminAddonRevisionsPlugin;

class Revision {

  const CHANGE_COUNT = 1;
  const CHANGE_NOT_EXISTS = 2;
  const CHANGE_CHANGED = 3;

  protected $plugin;
  protected $page;
  protected $name;

  protected $path = null;
  protected $changes = null;

  public function __construct($page, $name = null) {
    $this->plugin = AdminAddonRevisionsPlugin::instance();
    $this->page = $page;
    $this->name = $name;

    $this->path();
  }

  public function page() {
    return $this->page;
  }

  public function name() {
    return $this->name;
  }

  public function path() {
    if ($this->path === null && $this->name !== null) {
      $this->path = $this->page->path() . DS . $this->plugin->directoryName() . DS . $this->name();
    }

    return $this->path;
  }

  public function delete() {
    Folder::delete($this->path);
  }

  public function exists() {
    return file_exists($this->path) && is_dir($this->path);
  }

  public function create() {
    $this->name = date('Ymd-His');

    // Skip if exists
    if (file_exists($this->path())) {
      return false;
    }

    // Create directory
    $path = $this->path();
    mkdir($path);

    // Copy files
    $currentDir = $this->page->path();
    $currentFiles = Util::scandirForFiles($currentDir);
    foreach ($currentFiles as $file) {
      $currentPath = $currentDir . DS . $file;
      // TODO: Handle directories?
      copy($currentPath, $path . DS . $file);
    }

    return true;
  }

  public function files() {
    return Util::scandirForFiles($this->path);
  }

  public function createdAt() {
    $dir = $this->name;

    $year = substr($dir, 0, 4);
    $month = substr($dir, 4, 2);
    $day = substr($dir, 6, 2);
    $hour = substr($dir, 9, 2);
    $minute = substr($dir, 11, 2);
    $second = substr($dir, 13, 2);

    $str = "$year-$month-$day $hour:$minute:$second";
    return strtotime($str);
  }

  public function changesFast() {
    $currentDir = $this->page()->path();
    $currentFiles = Util::scandirForFiles($currentDir);

    $revDir = $this->path();
    $revFiles = Util::scandirForFiles($revDir);

    if (count($currentFiles) !== count($revFiles)) {
      return ['type' => self::CHANGE_COUNT];
    }

    foreach ($currentFiles as $curFile) {
      $key = array_search($curFile, $revFiles);
      if ($key === false) {
        return ['type' => self::CHANGE_NOT_EXISTS, 'file' => $curFile];
      }

      $revFile = $revDir . DS . $revFiles[$key];
      $curFile = $currentDir . DS . $curFile;
      if (filesize($curFile) !== filesize($revFile) || md5_file($curFile) !== md5_file($revFile)) {
        return ['type' => self::CHANGE_CHANGED, 'file' => $curFile];
      }
    }

    return false;
  }

  public function changes($refresh = false) {
    if (!$refresh && $this->changes !== null) {
      return $this->changes;
    }

    $pageDir = $this->page->path();
    $currentFiles = Util::scandirForFiles($pageDir);
    $revFiles = $this->files();

    $oldDir = $this->path;
    $oldFiles = $revFiles;
    $newDir = $pageDir;
    $newFiles = $currentFiles;

    $added = [];
    $removed = [];
    $changed = [];
    $renamed = [];
    $equal = [];

    // Find removed files
    foreach ($oldFiles as $oldFile) {
      if (array_search($oldFile, $newFiles) === false) {
        $removed[] = $oldFile;
      }
    }

    // Find added files
    foreach ($newFiles as $newFile) {
      if (array_search($newFile, $oldFiles) === false) {
        $added[] = $newFile;
      }
    }

    // Check for renamed files
    foreach ($added as $kAdded => $addedFile) {
      foreach ($removed as $kRemoved => $removedFile) {
        $addedPath = $newDir . DS . $addedFile;
        $removedPath = $oldDir . DS . $removedFile;
        if (!Util::fileChanged($addedPath, $removedPath)) {
          unset($added[$kAdded]);
          unset($removed[$kRemoved]);
          $renamed[] = ['from' => $removedFile, 'to' => $addedFile];
        }
      }
    }

    // Find changed and equal files
    foreach ($oldFiles as $oldFile) {
      $key = array_search($oldFile, $newFiles);
      if ($key !== false) {
        $newFile = $newFiles[$key];
        $oldPath = $oldDir . DS . $oldFile;
        $newPath = $newDir . DS . $newFile;
        if (Util::fileChanged($oldPath, $newPath)) {
          $changed[] = $oldFile;
        } else {
          $equal[] = $oldFile;
        }
      }
    }

    // Process changes
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    foreach ($changed as &$change) {
      $oldFile = $oldDir . DS . $change;
      $newFile = $newDir . DS . $change;

      $mime = finfo_file($finfo, $oldFile);
      if (strpos($mime, "text") === 0 || strpos($mime, "application") === 0) {
        // Handle text files
        $change = ['filename' => $change, 'type' => 'text'];
        $diff = Diff::compare(file_get_contents($oldFile), file_get_contents($newFile), true);
        $change['diff'] = Util::difftoHTML($diff);
      } else if (strpos($mime, "image") === 0) {
        // Handle image files
        $change = ['filename' => $change, 'type' => 'image'];
        $change['oldUrl'] = $this->filePathToUrl($oldFile);
        $change['newUrl'] = $this->filePathToUrl($newFile);
      } else {
        // Handle anything else
        $change = ['filename' => $change, 'type' => 'unknown'];
      }
    }
    finfo_close($finfo);

    $this->changes = compact('added', 'removed', 'renamed', 'changed', 'equal');

    return $this->changes;
  }

}