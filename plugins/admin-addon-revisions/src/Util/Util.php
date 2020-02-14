<?php
namespace AdminAddonRevisions\Util;

use Grav\Common\Grav;
use Grav\Plugin\AdminAddonRevisionsPlugin;
use AdminAddonRevisions\Util\Diff;

class Util {

  public static function filePathToUrl($filePath) {
    return Grav::instance()['base_url'] . preg_replace('|^' . preg_quote(GRAV_ROOT) . '|', '', $filePath);
  }

  public static function scandir($directory, $fileOnly = true) {
    $files = array_diff(scandir($directory), ['.', '..', AdminAddonRevisionsPlugin::instance()->directoryName()]);

    $files = array_filter($files, function($file) use($directory, $fileOnly) {
      $fileOnlyCondition = is_dir($directory . DS . $file) === !$fileOnly;
      $ignoredCondition = AdminAddonRevisionsPlugin::instance()->isIgnoredFile($directory . DS . $file);

      return $fileOnlyCondition && !$ignoredCondition;
    });

    return $files;
  }

  public static function scandirForFiles($directory) {
    return self::scandir($directory, true);
  }

  public static function scandirForDirectories($directory) {
    return self::scandir($directory, false);
  }

  public static function fileChanged($path1, $path2) {
    return filesize($path1) !== filesize($path2)
            || md5_file($path1) !== md5_file($path2);
  }

  public static function diffToHTML($diff) {
    $html = '';

    foreach ($diff as $c) {
      switch ($c[1]) {
        case Diff::UNMODIFIED:
          $html .= '' . $c[0];
          break;
        case Diff::INSERTED:
          $html .= '<span class="inserted">' . $c[0]. '</span>';
          break;
        case Diff::DELETED:
          $html .= '<span class="deleted">' . $c[0]. '</span>';
          break;
      }
    }

    return $html;
  }

}