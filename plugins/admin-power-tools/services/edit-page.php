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

	if ($config->get('plugins.admin-power-tools.edit_section_enabled', true)) {

		function get(&$container, $item, $default)
		{
			if (isset($container[$item])) {
				return $container[$item];
			} else {
				return $default;
			}
		}

		$route = \Grav\Common\Grav::instance()['admin']->route;
		$route = preg_replace("#^edit-section/#", "", $route);
		$manager->registerService('action', [
			'scope' => ['edit:section'],

			'caption' => 'Move Section To Child Page',
			'order' => 'after:parent',
			'icon' => 'fa-arrows',

			'clientCallback' => "_doMoveSectionToChildPage();",

			'serverCallbackId' => 'move-to-child',
//            'serverCallbackContext' => [
//                "route" => $route,
//                "section" => get($_GET, 'section', "")
//            ],
			'serverHandler' => function ($context) {
				$grav = \Grav\Common\Grav::instance();
				$grav['admin']::enablePages();

				$route = $context['route'];
				$section = $context['section'];
				$newSectionName = $context['new_section'];
				$newContent = $context['new_content'];

				$page = $grav['pages']->find($route);

				//$sectionContents = \MarkdownTools::getSectionContents($page->rawMarkdown(), $section);
				$sectionName = \MarkdownTools::getSectionName($section);

				$newPage = new \Grav\Common\Page\Page();
				$newPage->header((array)$page->header());
				$newPage->rawMarkdown($newContent);
				$newPage->header()->title = $newSectionName;
				$newPage->title($newSectionName);
				$newPage->template($page->template());
				$newPage->parent($page);

				$slugNew = \Grav\Plugin\Admin\Utils::slug($sectionName);
				$slugNew = \Grav\Plugin\AdminPowerToolsPlugin::getUniqueSlug($page, $slugNew);
				$order = \Grav\Plugin\Admin\AdminController::getNextOrderInFolder($page->path());
//            $path = $page->path() . '/' . sprintf("%02d", $order) . '.' . $slugNew;
//            $newPage->path($path);
				$newPage->filePath(dirname($page->filePath()) . '/' . sprintf("%02d", $order) . '.' . $slugNew . '/' . basename($page->filePath()));
				$newPage->route($page->route() . '/' . $slugNew);
				$newPage->rawRoute($newPage->parent()->rawRoute() . '/' . $slugNew);
				$newPage->save();

				$trimmed = MarkdownTools::removeSection($page->rawMarkdown(), $section);
				$page->rawMarkdown($trimmed);
				$page->save();

				$util = $grav['core-service-util'];
				$util->updateAdminCache();
				$grav->redirect($util->routeToEdit($newPage));
			},
		]);
	}
}
