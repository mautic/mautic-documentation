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
{
    $config = \Grav\Common\Grav::instance()['config'];
    $manager = \Twelvetone\Common\ServiceManager::getInstance();

    if ($config->get('plugins.admin-power-tools.reports_enabled', true)) {

        include_once __DIR__ . '/../classes/ReportUtil.php';

        /**
         * Search the array for an item an returns the first one found.
         * @param $array
         * @param $filter
         * @return mixed
         */
        function array_find($filter, $array)
        {
            foreach ($array as $item) {
                if ($filter($item)) {
                    return $item;
                }
            }
            return null;
        }

        $manager->registerService('report', [
            "caption" => "All Pages",
            'icon' => "fa-copy",
            "generate" => function () {
                $pages = [];
                $root = \Grav\Common\Grav::instance()['pages']->root();
                page_walker($root, function ($page) use (&$pages) {
                    $pages[] = $page;
                });
                $s = '';

                foreach ($pages as $k => $v) {
                    $level = 0;
                    $p = $v;
                    while ($p->parent() !== null) {
                        $p = $p->parent();
                        $level++;
                    }
                    $url = ReportUtil::view_url($v);
                    $url_edit = ReportUtil::edit_url($v);
                    $s .= "<div style='margin-left:${level}em' class='report-item'><a href='$url'>" . $v->title() . "</a> <a href='$url_edit'><i class='fa fa-edit'></i></a> <a href='$url'><i class='fa fa-eye'></i></a></div>";
                }
                return $s;
            }
        ]);

        $grav = \Grav\Common\Grav::instance();
        $url = $grav['core-service-util']->routeToAdmin();
        $url .= "/admin-power-tools/reports";
        $manager->registerService('action', [
            "caption" => "Reports",
            "icon" => "fa-list",
            "scope" => ["admin:sidebar"],
            "order" => "after:parent",
            "clientCallback" => "window.location.href=\"$url\"",
            'isSelected' => function ($context) {
                // Selected for the list (reports/) and individual reports (report/).
                return strpos(\Grav\Common\Grav::instance()['uri']->route(), "/admin-power-tools/report") != false;
            }
        ]);

        $manager->registerService('action', [
            "caption" => "Reports",
            "icon" => "fa-list",
            "scope" => ['report'],
            "order" => 'after:parent',
            "clientCallback" => "window.location.href=\"$url\"",
        ]);


        $manager->registerService('report', [
            "caption" => "Unused Media",
            'icon' => "fa-image",
            "generate" => function () {
                $tree = ReportUtil::getUnusedMedia();
                return ReportUtil::generate($tree);
            }
        ]);

        $manager->registerService('report', [
            "caption" => "Missing Media",
            'icon' => "fa-image",
            "generate" => function () {
                \Grav\Common\Grav::instance()['assets']->addCss("plugin://admin-power-tools/assets/report.css");
                $tree = ReportUtil::getMissingMedia();
                return ReportUtil::generate($tree);
            }
        ]);

//$manager->registerService('report', [
//    "caption" => "Unused Pages",
//    "generate" => function () {
//        return "Not Implemented";
//    }
//]);

//    $manager->registerService('report', [
//        "caption" => "Broken Links",
//        "generate" => function () {
//            return "Not Implemented";
//        }
//    ]);

//$manager->registerService('report', [
//    "caption" => "Report Util Test",
//    "generate" => function () {
//        return ReportUtil::generate(ReportUtil::getSampleTree());
//    }
//]);


//$manager->registerService('report', [
//    "caption" => "Media Usage Test",
//    "generate" => function () {
//        \Grav\Common\Grav::instance()['assets']->addCss("plugin://admin-power-tools/assets/report.css");
//        return ReportUtil::generate(ReportUtil::getMediaUsage());
//    }
//]);

        $manager->registerService('report', [
            "caption" => "All Links and Images",
            'icon' => "fa-link",
            "generate" => function () {
                $mapA = []; // href to pages
                $mapImg = []; // src to pages

                $root = \Grav\Common\Grav::instance()['pages']->root();
                page_walker($root, function ($page) use (&$mapA, &$mapImg) {

                    $dom = new DOMDocument();
                    try {
                        $dom->loadHTML($page->content());
                    } catch (Throwable $e) {
                        // loadHTML will throw exception if content is empty
                        return;
                    }
                    $items = $dom->getElementsByTagName('a');
                    foreach ($items as $a) {
                        if (!$a->attributes->getNamedItem('href')) {
                            $value = "*missing*";
                        } else {
                            $value = $a->attributes->getNamedItem('href')->nodeValue;
                        }
                        if (!isset($mapA[$value])) {
                            $mapA[$value] = [];
                        }
                        if (array_find(function ($a) use (&$page) {
                                return $a->title() === $page->title();
                            }, $mapA[$value]) === null) {
                            $mapA[$value][] = $page;
                        }
                    }
                    $items = $dom->getElementsByTagName('img');
                    foreach ($items as $a) {
                        if (!$a->attributes->getNamedItem('src')) {
                            $value = "*missing*";
                        } else {
                            $value = $a->attributes->getNamedItem('src')->nodeValue;
                        }
                        if (!isset($mapImg[$value])) {
                            $mapImg[$value] = [];
                        }
                        if (array_find(function ($a) use ($page) {
                                return $a->title() === $page->title();
                            }, $mapImg[$value]) === null) {
                            $mapImg[$value][] = $page;
                        }
                    }
                });

                function pageList($pages)
                {
                    $titles = array_map(function ($a) {
                        $url = $a->url();
                        return "<span class='page-title'><a href='$url'>" . $a->title() . "</a></span>";
                    }, $pages);
                    return join(" ", $titles);
                }

                $s = '';
                $s .= "<div class='report-section-container'>";
                $s .= "<div class='report-section'>Links</div>";
                foreach ($mapA as $k => $v) {
                    $url = $k;
                    $s .= "<div class='report-item'><a href='$url' target='_blank'>" . $k . "</a>";
                    $s .= "<div class='report-usedby'>" . pageList($v) . "</div>";
                    $s .= "</div>";
                }
                $s .= "</div>";

                $s .= "<div class='report-section-container'>";
                $s .= "<div class='report-section'>Images</div>";
                foreach ($mapImg as $k => $v) {
                    $url = $k;
                    $s .= "<div class='report-item'><a href='$url' target='_blank'>" . $k . "</a>";
                    $s .= "<div class='report-usedby'>" . pageList($v) . "</div>";
                    $s .= "</div>";
                }
                $s .= "</div>";

                return $s;
            }
        ]);

        $manager->registerService('report', [
            "caption" => "Media By Page",
            'icon' => "fa-image",
            "generate" => function () {
                $s = '';
                $root = \Grav\Common\Grav::instance()['pages']->root();
                page_walker($root, function ($page) use (&$s) {
                    $medias = $page->media()->all();
                    if (count($medias) == 0) {
                        return;
                    }
                    $title = $page->title();
                    $pageUrl = ReportUtil::edit_url($page);
                    $s .= "<div class='report-section-container'>";
                    $s .= "<h2 class='report-section'><a href='$pageUrl'>$title</a></h2>";
                    foreach ($medias as $media) {
                        $url = $media->url();
                        $s .= "<div class='report-item'><i class='fa fa-file'></i> <a href='$url' target='_blank'>" . basename($media->path()) . "</a></div>";
                    }
                    $s .= "</div>";
                });
                return $s;
            }
        ]);

        $manager->registerService('report', [
            "caption" => "Page By Type",
            'icon' => "fa-copy",
            "generate" => function () {
                $tree = [
                    'Visible' => [],
                    'Non-Routable' => [],
                    'Non-Visible' => [],
                    'Modular' => [],
                    'Dynamic' => [],
                ];

                $root = \Grav\Common\Grav::instance()['pages']->root();
                page_walker($root, function ($page) use (&$tree) {
                    $link = ReportUtil::view_edit_link($page, $page->title());
                    if (!$page->path()) {
                        $tree['Dynamic'][] = $link;
                    } else if ($page->modular()) {
                        $tree['Modular'][] = $link;
                    } else if (!$page->routable()) {
                        $tree['Non-Routable'][] = $link;
                    } else if (!$page->visible()) {
                        $tree['Non-Visible'][] = $link;
                    } else {
                        $tree['Visible'][] = $link;
                    }
                });
                return ReportUtil::generate($tree);
            }
        ]);

        $manager->registerService('report', [
            "caption" => "Page References",
            'icon' => "fa-copy",
            "generate" => function () {
                $grav = \Grav\Common\Grav::instance();
                $base = $grav['uri']->rootUrl(false);
                $links = [
                    'internal' => [],
                    'external' => []
                ];

                $root = $grav['pages']->root();
                page_link_walker($root, function ($link, $page) use (&$links, $base) {
                    if (\Grav\Common\Utils::startsWith($base, $link)) {
                        $bin = 'internal';
                    } else {
                        $bin = 'external';
                    }
                    if (!in_array($link, $links[$bin])) {
                        $links[$bin][] = $link;
                    }
                });

                foreach ($links as &$bin) {
                    sort($bin);
                }

                return ReportUtil::generate($links);
            }
        ]);


        $manager->registerService('report', [
            "caption" => "Services",
            'icon' => "fa-cogs",
            "generate" => function () {
                $tree = [];
                $manager = \Twelvetone\Common\ServiceManager::getInstance();
                foreach ($manager->getServiceIds() as $serviceId) {
                    $serviceInfo = $manager->getServiceInfo($serviceId);
                    $serviceName = $serviceInfo->service;
                    if (!isset($tree[$serviceName])) {
                        $tree[$serviceName] = [];
                    }
                    $propsByName = [];
                    foreach ($serviceInfo->properties as $name => $value) {
                        if (is_array($value)) {
                            $value = '[' . join(', ', $value) . ']';
                        }
                        $propsByName[] = "$name: $value";
                    }
                    $service = $manager->getService($serviceId);
                    if (isset($service['caption'])) {
                        $propsByName[] = "_CAPTION: " . $service['caption'];
                    }
                    $tree[$serviceName][$serviceId] = [
                        'properties' => join("<br />", $propsByName)
//                        [
//                            "count" => ['' . count($serviceInfo['properties'])],
//                            "values" => $propsByName,
//                        ]
                    ];
                }

                return ReportUtil::generate($tree);
            }
        ]);

        //
        // PAGE
        //

        $manager->registerService('page', [
            "scope" => ['admin'],
            "rxroute" => "/admin-power-tools/reports",
            "getPage" => function ($route) {
                $page = new \Grav\Common\Page\Page();
                $page->init(new \SplFileInfo(__DIR__ . "/../pages-internal/report_list.md"));
                return $page;
            }
        ]);

        $manager->registerService('page', [
            "scope" => ['admin'],
            "rxroute" => "/admin-power-tools/report/.*",
            "getPage" => function ($route) {
                $page = new \Grav\Common\Page\Page();
                $page->init(new \SplFileInfo(__DIR__ . "/../pages-internal/report.md"));

                $reportId = basename($route);
                $reports = \Twelvetone\Common\ServiceManager::getInstance()->getServices('report');
                $report = current(array_filter($reports, function ($a) use ($reportId) {
                    $id = \Grav\Common\Grav::instance()['inflector']->hyphenize($a['caption']);
                    return $id === $reportId;
                }));
                if (!$report) {
                    die('Report Not Found');
                }
                $page->setRawContent($report['generate']());
                $page->title($report['caption']);
                return $page;
            }
        ]);

        $manager->registerService("asset", [
            "type" => 'css',
            "url" => "plugin://admin-power-tools/assets/report.css",
            "scope" => ["all"],
            "order" => "last",
        ]);

    }
}
