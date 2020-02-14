<?php
namespace AdminAddonRevisions;

use AdminAddonRevisions\Util\Util;

class TaskHandler {

  public function __construct($plugin) {
    $this->plugin = $plugin;
    $this->admin = $plugin->grav()['admin'];
    $this->uri = $plugin->grav()['uri'];
  }

  public function execute($method) {
    if (method_exists($this, $method)) {
      return call_user_func([$this, $method]);
    }

    return false;
  }

  public function taskRevDelete() {
    $messages = $this->plugin->grav()['messages'];
    // TODO: Permission

    $rev = $this->uri->param('rev');
    if (!$rev) {
      $messages->add("Revision param is missing", 'error');
      $this->plugin->grav()->redirect($this->uri->path());
      return false;
    }

    $page = $this->plugin->getCurrentPage();
    $revision = new Revision($page, $rev);
    if (!$revision->exists()) {
      $messages->add("Revision not found", 'error');
      $this->plugin->grav()->redirect($this->uri->path());
      return false;
    }

    $revision->delete();

    $messages->add("Succesfully deleted the '$rev' revision", 'info');
    $this->plugin->grav()->redirect($this->uri->path());

    return true;
  }

  public function taskRevRevert() {
    // TODO: Permission

    $rev = $this->uri->param('rev');
    if (!$rev) {
      // TODO: Message
      return false;
    }

    $page = $this->plugin->getCurrentPage();
    $revision = new Revision($page, $rev);
    if (!$revision->exists()) {
      // TODO: Message
      return false;
    }

    // Get rid of the current files (we have them as the last revision)
    $currentDir = $page->path();
    $currentFiles = Util::scandirForFiles($currentDir);
    foreach ($currentFiles as $currentFile) {
      unlink($currentDir . DS . $currentFile);
    }

    // Copy files from the revision to the page folder
    $revDir = $revision->path();
    $revFiles = $revision->files();
    foreach ($revFiles as $revFile) {
      copy($revDir . DS . $revFile, $currentDir . DS . $revFile);
    }

    // Create a new revision
    // TODO: Limiting
    $revision = new Revision($page);
    $revision->create();

    $messages = $this->plugin->grav()['messages'];
    $messages->add("Succesfully reverted to the '$rev' revision", 'info');
    $this->plugin->grav()->redirect($this->uri->path());

    return true;
  }

  public function taskRevDeleteAll() {
    $pages = $this->plugin->grav()['pages']->instances();
    foreach ($pages as $page) {
      $revisions = new Revisions($page);
      $revisions->delete();
      unset($revisions);
    }

    $messages = $this->plugin->grav()['messages'];
    $messages->add('Succesfully deleted all revisions', 'info');
    $this->plugin->grav()->redirect($this->uri->path());

    return true;
  }

}