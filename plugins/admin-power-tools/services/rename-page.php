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

use Grav\Common\Filesystem\Folder;

{
    $config = \Grav\Common\Grav::instance()['config'];

    if ($config->get('plugins.admin-power-tools.rename_page_enabled', false)) {

        $manager = \Twelvetone\Common\ServiceManager::getInstance();
        $taskId = 'rename-page-custom';

        $manager->registerService("action", [
            'caption' => 'Rename Page',
            'icon' => 'fa-arrows',
            'scope' => ['page:more'],
            'order' => 'after:parent',
            'isEnabled' => function ($page) {
                return $page && $page->exists();
            },

            'form_id' => $taskId,
            'form_blueprint' => newBlueprint($taskId),
            'form_data' => function ($page) {
                return ['page' => $page];
            },
            'clientCallback' => '_showForm("' . $taskId . '", {page_name:"the-current-name"})'
        ]);

        $manager->registerService("task", [
            'name' => $taskId,
            'execute' => function () {

                $data = $_POST['data'];

                $current_route = '/' . $data['current_route'];
                $page_name = $data['page_name'];
                $rename_slug = $data['rename_slug'];
                $rename_route_references = $data['rename_route_references'];
                $rename_title_references = $data['rename_title_references'];

                $grav = \Grav\Common\Grav::instance();
                $page = $grav['pages']->find($current_route);
                if (!$page) {
                    die("Page not found for route: $current_route");
                }

                $origSlug = $page->slug();
                $origPath = $page->path();
                $origTitle = $page->title();

                $page->header()->title = $page_name;
                if ($rename_slug) {
                    $newSlug = \Grav\Plugin\Admin\Utils::slug($page_name);
                    $page->slug($newSlug);
                    if ($page->order() != false) {
                        $page->folder(sprintf('%02d.', $page->order()) . $newSlug);
                    } else {
                        $page->folder($newSlug);
                    }
                }
                $rx = "#\\(\\($origTitle\\)\\)#";

                $page->route($page->parent()->route() . '/' . $page->slug());
                Folder::move($origPath, $page->path());
                //BUG not deleting/copying older folder
                //$page->move($page->parent());
				$grav['core-service-util']->save($page);



				if ($rename_route_references) {
                    $base = $grav['uri']->rootUrl(false);
                    $absPath = $base . $current_route;
                    $newAbsPage = $base . $page->route();
                    $refs = [];
                    page_link_walker($grav['pages']->root(), function ($link, $page) use (&$refs, $absPath, $origSlug) {
                        if ($link === $absPath) {
                            if (!isset($refs[$page->route()])) {
                                $refs[$page->route()] = $page;
                            }
                        }
                    });
                    if (count($refs) > 0) {
                        //TODO only replace href
                        $rx = "#(\\(.*?)($current_route)(.*?\\))#";
                        $newAbsPath = $base . $page->route();
                        foreach ($refs as $route => $p) {
                            $content = $p->rawMarkdown();
                            //$content = preg_replace($rx, "$1$newRoute$3", $content);
                            $content = str_replace($absPath, $newAbsPage, $content);
                            $content = str_replace($current_route, $page->route(), $content);
                            $content = str_replace($origSlug, $page->slug(), $content);
                            $p->rawMarkdown($content);
                            $p->save();
                        }
                    }
                }
                if ($rename_title_references) {
                    page_walker($grav['pages']->root(), function ($p) use (&$refs, $origTitle, $page_name) {
                        $rx = "#\\(\\($origTitle\\)\\)#";
                        $content = $p->rawMarkdown();
                        $content = preg_replace($rx, "(($page_name))", $content, -1, $count);
                        if ($count > 0) {
                            $p->rawMarkdown($content);
                            $p->save();
                        }
                    });
                }
				$grav['core-service-util']->updateAdminCache();
				$routeToEdit = $grav['core-service-util']->routeToEdit($page);
				$grav->redirect($routeToEdit);
            }
        ]);

        $manager->registerService('asset', [
            'scope' => ['page'],
            'order' => 'last',
            'type' => 'js',
            'url' => 'plugin://admin-power-tools/assets/show_form.js'
        ]);

    }
}
