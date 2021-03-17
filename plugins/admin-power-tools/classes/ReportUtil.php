<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2018 TwelveTone LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

use Grav\Common\Page\Page;

/**
 * Walks all child pages.  Does not visit the root page.
 * @param $page
 * @param $visitor
 */
function page_walker(Page $page, $visitor)
{
    foreach ($page->children() as $child) {
        $visitor($child);
        page_walker($child, $visitor);
    }
}

/**
 * Walks all page links.  Does not visit the root page.
 * @param $page
 * @param $visitor callable string, array
 */
function link_walker(Page $page, $visitor)
{
    $dom = new DOMDocument();
    try {
        $dom->loadHTML($page->content());
    } catch (Throwable $e) {
        // loadHTML will throw exception if content is empty
        return;
    }
    $items = $dom->getElementsByTagName('a');
    foreach ($items as $a) {
        if ($a->attributes->getNamedItem('href')) {
            $value = $a->attributes->getNamedItem('href')->nodeValue;
            $visitor($value, $page);
        }
    }
}

/**
 * Walks all pages links.  Does not visit the root page.
 * @param $page
 * @param $visitor callable string, array
 */
function page_link_walker(Page $page, $visitor)
{
    page_walker($page, function ($p) use ($visitor) {
        link_walker($p, $visitor);
    });
}

class ReportUtil
{
    // the folder and media name
    const rxMedia = "#.*/([^/]+/[^?]+)$#";

    static public function getSampleTree()
    {
        return [
            "item 1" => [
                "1:1", "1:2"
            ],
            "item 2" => [
                "2:1", "2:2", "2,3" => ["a", "b", "c"]
            ],
            "item 3" => [
                "3:1", "3:2"
            ]
        ];
    }

    static public function generate($tree)
    {
        $level = 1;
        $s = "";
        function render(&$tree, $level, &$s)
        {
            foreach ($tree as $k => $v) {
                if ($level == 1) {
                    $s .= "<div class='report-section-container'>";
                    if (is_array($v)) {
                        $s .= "<div class='h$level report-section'>" . $k;
                        $s .= "</div>";
                        render($v, $level + 1, $s);
                    } else {
                        $s .= "<div class='h$level report-item'>" . $v;
                        $s .= "</div>";

                    }
                    $s .= "</div>";
                } else {
                    if (is_array($v)) {
                        $s .= "<div class='h$level report-section'>" . $k;
                        $s .= "</div>";
                        render($v, $level + 1, $s);
                    } else {
                        $s .= "<div class='h$level report-item'>" . $v;
                        $s .= "</div>";

                    }
                }
            }
        }

        render($tree, $level, $s);

        return "<div class='report-tree'>" . $s . "</div>";
    }

	/**
	 * @deprecated use CoreServiceUtil::routeToAdmin
	 * @return string
	 */
    public static function getAdminBaseRelative()
    {
        $config = \Grav\Common\Grav::instance()['config'];
        $route = $config->get('plugins.admin.route');
        $base = '/' . trim($route, '/');
        return isset($config->grav['base_url_relative']) ? $config->grav['base_url_relative'] . $base : $base;
//        $admin_base = '/' . trim($config->get('plugins.admin.route'), '/');
//        $admin_base = trim($config->get('plugins.admin.route'), '/');
//        return $admin_base;
    }

    public static function edit_link($page, $text)
    {
		$grav = \Grav\Common\Grav::instance();
		$url = $grav['core-service-util']->routeToAdmin();
		$href = $url . "/pages" . $page->route();
        return "<a href='$href'>" . $text . "</a>";
    }

    public static function view_edit_link($page, $text)
    {
        $viewUrl = self::view_url($page);
        $editUrl = self::edit_url($page);
        return "<a href='$viewUrl'>" . $text . "</a> <a href='$editUrl'><i class='fa fa-edit'></i></a> <a href='$viewUrl'><i class='fa fa-eye'></i></a>";
    }

    public static function view_url($page)
    {
    	$grav = \Grav\Common\Grav::instance();
		$base = isset($grav['base_url_relative']) ? $grav['base_url_relative'] : '';
		return $base . $page->route();
    }

    public static function edit_url($page)
    {
		$grav = \Grav\Common\Grav::instance();
		$url = $grav['core-service-util']->routeToAdmin();
		$href = $url . "/pages" . $page->route();
        return $href;
    }

    const rxPath = '#(\d+\.)?(.*)#';

    public static function comparePaths($p1, $p2)
    {
        $p1 = self::stripOrder($p1);
        $p2 = self::stripOrder($p2);
        return $p1 === $p2;
    }

    public static function stripOrder($p1)
    {
        return preg_replace(ReportUtil::rxPath, "$2", $p1);
    }

    public static function getUnusedMedia()
    {
        $tree = [
            'links' => []
        ];
        $root = \Grav\Common\Grav::instance()['pages']->root();
        page_walker($root, function ($page) use (&$tree) {
            $dom = new DOMDocument();
            try {
                $dom->loadHTML($page->content());
                $items = $dom->getElementsByTagName('img');
                foreach ($items as $item) {
                    $ni = $item->attributes->getNamedItem('src');
                    if ($ni) {
                        preg_match(self::rxMedia, $ni->nodeValue, $m);
                        $tree['links'][] = self::stripOrder($m[1]);
                    }
                }
            } catch (Throwable $e) {
                // loadHTML will throw exception if content is empty;
            }
        });

        $unused = [];
        page_walker($root, function ($page) use (&$tree, &$unused) {
            $medias = $page->media()->all();
            foreach ($medias as $media) {
                preg_match(self::rxMedia, $media->path(), $m);
                $path = self::stripOrder($m[1]);
                if (!in_array($path, $tree['links'])) {
                    $url = $media->url();

                    $html = "";
                    $html .= self::edit_link($page, $page->title()) . ' -> ' . self::edit_link($page, $page->route());
                    $html .= "<br /><img src='$url' style='height:60px;'></img>";
                    $unused[$path] = $html;
//                    $unused[$path] = [
//                        "page" => ,
//                        "preview" =>
//                    ];
                }
            }
        });

        return $unused;
    }


    public static function getMissingMedia()
    {
        $tree = [
            'media' => []
        ];

        $root = \Grav\Common\Grav::instance()['pages']->root();
        page_walker($root, function ($page) use (&$tree, &$unused) {
            $medias = $page->media()->all();
            foreach ($medias as $media) {
                preg_match(self::rxMedia, $media->path(), $m);
                $path = self::stripOrder($m[1]);
                if (!in_array($path, $tree['media'])) {
                    $tree['media'][] = $path;
                }
            }
        });

        $missing = [];
        page_walker($root, function ($page) use (&$tree, &$missing) {
            $dom = new DOMDocument();
            try {
                $dom->loadHTML($page->content());
                $items = $dom->getElementsByTagName('img');
                foreach ($items as $item) {
                    $ni = $item->attributes->getNamedItem('src');
                    if ($ni) {
                        preg_match(self::rxMedia, $ni->nodeValue, $m);
                        $path = self::stripOrder($m[1]);
                        if (!self::isCachedPath($page)) {
                            if (!in_array($path, $tree['media'])) {
                                $missing[] = self::edit_link($page, $page->route()) . ' -> ' . $path;
                            }
                        }
                    }
                }
            } catch (Throwable $e) {
                // loadHTML will throw exception if content is empty;
            }
        });


        return $missing;
    }

    public static function getMediaUsage()
    {
        $tree = [
            'medias' => [],
            'links' => []
        ];
        $root = \Grav\Common\Grav::instance()['pages']->root();
        page_walker($root, function ($page) use (&$tree) {
            $medias = $page->media()->all();
            foreach ($medias as $media) {
                preg_match(self::rxMedia, $media->path(), $m);
                $tree['medias'][] = self::stripOrder($m[1]);
            }
            $dom = new DOMDocument();
            try {
                $dom->loadHTML($page->content());
                $items = $dom->getElementsByTagName('img');
                foreach ($items as $item) {
                    $ni = $item->attributes->getNamedItem('src');
                    if ($ni) {
                        preg_match(self::rxMedia, $ni->nodeValue, $m);
                        $tree['links'][] = self::stripOrder($m[1]);
                    }
                }
            } catch (Exception $e) {
                // loadHTML will throw exception if content is empty;
            }
        });

        return $tree;
    }


    // a/.. or 6/..
    const rxCached = '#^[a-z0-9]/#';

    public static function isCachedPath($page)
    {
        return preg_match(self::rxCached, $page);
    }
}
