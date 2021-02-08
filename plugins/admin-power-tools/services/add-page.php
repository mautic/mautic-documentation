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

function newBlueprint($name)
{
	$bpNewPage = new \Grav\Common\Data\Blueprint("$name.yaml");
	$bpNewPage->setContext(__DIR__ . "/../blueprints");
	$bpNewPage = $bpNewPage->load()->init();
	return $bpNewPage;
}

$manager = \Twelvetone\Common\ServiceManager::getInstance();
$manager->registerService("asset", [
	"type" => 'js',
	"url" => "plugins://admin-power-tools/assets/dialog_util.js",
	"scope" => ["all"],
	"order" => "last",
]);

// These actions are currently broken in v 1.7
$grav = \Grav\Common\Grav::instance();
if ($grav['core-service-util']->adminVersionIs('<', '1.7')) {
	$config = \Grav\Common\Grav::instance()['config'];


	if ($config->get('plugins.admin-power-tools.add_page_enabled', true)) {


//
// Menu items in the +Add page dropdown
//

		{
			$bp2 = newBlueprint("new-page-custom-2");
			$manager->registerService("action", [
				'caption' => 'Add Page Like This',
				'scope' => ['page'],
				'order' => 'last',
				'form_id' => "new-page-custom-this",
				'form_blueprint' => &$bp2,
				'isVisible' => function (&$page) use (&$bp2) {
					$bp2->set("form/fields/section/title", "Add Page Like " . $page->title());
					$bp2->set("form/fields/page_like/default", $page->route());
					return true;
				},
				'form_data' => function (&$page) use (&$bp2) {
					return ['page' => $page];
				}
			], [
				"menu" => "page:add"
			]);
		}

		{
			$bp3 = newBlueprint("new-page-custom-2");
			$manager->registerService("action", [
				'caption' => 'Add Page Like Child',
				'scope' => ['page'],
				'order' => 'last',
				'isVisible' => function (&$page) use (&$bp3) {
					$ret = $page->children()->count() > 0;
					if ($ret) {
						$bp3->set("form/fields/section/title", "Add Page Like " . $page->children()->first()->title());
						$bp3->set("form/fields/page_like/default", $page->children()->first()->route());
					}
					return $ret;
				},
				'form_id' => "new-page-custom-child",
				'form_blueprint' => &$bp3,
				'form_data' => function (&$page) use (&$bp3) {
					$bp3->set("form/fields/section/title", "Add Page Like " . $page->children()->first()->title());
					return ['page' => $page->children->first()];
				}
			], [
				"menu" => "page:add"
			]);
		}

		{
			$bp4 = newBlueprint("new-page-custom-2");
			$manager->registerService("action", [
				'caption' => 'Add Page Like Parent',
				'scope' => ['page'],
				'order' => 'last',
				'isVisible' => function (&$page) use (&$bp4) {
					$ret = $page->parent()->route() !== null;
					if ($ret) {
						$bp4->set("form/fields/section/title", "Add Page Like " . $page->parent()->title());
						$bp4->set("form/fields/page_like/default", $page->parent()->route());
					}
					return $ret;
				},
				'form_id' => 'new-page-custom-parent',
				'form_blueprint' => &$bp4,
				'form_data' => function (&$page) use (&$bp4) {
					$bp4->set("form/fields/section/title", "Add Page Like " . $page->parent()->title());
					return ['page' => $page->parent()];
				}
			], [
				"menu" => "page:add"
			]);
		}

		{
			$bp5 = newBlueprint("new-page-custom-2");
			$bp5->set("form/fields/section/title", "Add Child Page");
			$manager->registerService("action", [
				'caption' => 'Add Child Page',
				'scope' => ['page'],
				'order' => 'last',
				'isVisible' => function (&$page) use (&$bp5) {
					$bp5->set("form/fields/page_like/default", $page->route());
					return true;
				},
				'form_id' => 'new-page-child',
				'form_blueprint' => &$bp5,
				'form_data' => function (&$page) use (&$bp5) {
					$bp5->set("form/fields/page_like/default", $page->route());
					return ['page' => $page];
				}
			], [
				"menu" => "page:add"
			]);
		}

		{
			$formId = 'new-page-custom';
			$bpNewPage = newBlueprint($formId);
			$manager->registerService("action", [
				'caption' => 'Add Page Like ...',
				'scope' => ['page', 'pages', 'dashboard'],
				'order' => 'last',
				'isVisible' => function ($page) {
					return true;
				},
				'form_id' => $formId,
				'form_blueprint' => $bpNewPage
			], [
				"menu" => "page:add"
			]);
		}

		{
			$formId1 = 'copy-page-custom';
			$bpNewPage1 = newBlueprint($formId1);
			$manager->registerService("action", [
				'caption' => 'Copy Page ...',
				'scope' => ['page', 'pages', 'dashboard'],
				'order' => 'last',
				'isVisible' => function ($page) {
					return true;
				},
				'form_id' => $formId1,
				'form_blueprint' => $bpNewPage1
			], [
				"menu" => "page:add"
			]);
		}
	}
}
