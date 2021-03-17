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

// This is broken, so disabling.
if (false) {
	$config = \Grav\Common\Grav::instance()['config'];

	if ($config->get('plugins.admin-power-tools.move_page_enabled', false)) {

		$manager = \Twelvetone\Common\ServiceManager::getInstance();

		$bpMove = newBlueprint("move-page-custom");

		$formIdMovePage = 'move-page-custom';
		$bpNewPage = newBlueprint($formIdMovePage);
		$manager->registerService("action", [
			'caption' => 'Move Page',
			'icon' => 'fa-arrows',
			'scope' => ['page:more'],
			'order' => 'after:parent',
			'isVisible' => function ($page) {
				return $page && $page->exists();
			},
			'form_id' => $formIdMovePage,
			'form_blueprint' => &$bpMove,
			'form_data' => function (&$page) use (&$bpMove) {
				return ['page' => $page];
			},
			'clientCallback' => '_movePage();'
		]);

		$manager->registerService('asset', [
			'scope' => ['page'],
			'order' => 'last',
			'type' => 'js',
			'url' => 'plugin://admin-power-tools/assets/move_page.js'
		]);

		$manager->registerService('asset', [
			'scope' => ['page'],
			'order' => 'last',
			'type' => 'js',
			'url' => \Grav\Common\Grav::instance()['locator']->findResource('plugin://admin-power-tools/assets/webcomponent/bower_components/webcomponentsjs/webcomponents-lite.js', false)
		]);


		$manager->registerService('asset', [
			'scope' => ['page'],
			'order' => 'last',
			'type' => 'link',
			'rel' => 'import',
			'url' => \Grav\Common\Utils::url('plugin://admin-power-tools/assets/webcomponent/bower_components/paper-autocomplete/paper-autocomplete.html')
		]);
	}
}
