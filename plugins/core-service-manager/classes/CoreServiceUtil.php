<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2018-2020 TwelveTone LLC
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

namespace Grav\Plugin;

use Grav\Common\Cache;
use Grav\Common\Page\Page;
use Twelvetone\Common\DependencyUtil;

class CoreServiceUtil
{
	private $grav;

	public function __construct($grav)
	{
		$this->grav = $grav;
	}

	/**
	 *
	 */
	public function checkAllPluginDependencies()
	{
		//WORKAROUND Broken in current Grav version
//		DependencyUtil::checkAllPluginDependencies();
	}

	/**
	 * @param $plugin
	 * @param null $issues
	 * @return bool
	 */
	public function checkPluginDependencies($plugin, &$issues = null): bool
	{
		return DependencyUtil::checkDependencies($plugin, $issues);
	}

	/**
	 * Call this function, after saving a page, if needing to redirect back to the page's admin.
	 */
	public function updateAdminCache(): void
	{
		if ($this->adminVersionIs('>=', '1.10.0-rc.0')) {
			Cache::clearCache('invalidate');
			$flex = $this->grav['flex'];
			$directory = $flex->getDirectory('pages');
			$directory->clearCache();
		}
	}

	/**
	 * A workaround that saves a page and then updates relevant Admin plugin caches.
	 * @param Page $page
	 */
	public function save(Page $page): void
	{
		$page->save();
		$this->updateAdminCache();
	}

	/**
	 * @param $operator @see version_compare()
	 * @param $semanticVersion @see version_compare()
	 * @return bool
	 */
	public function gravVersionIs($operator, $semanticVersion): bool
	{
		return version_compare(GRAV_VERSION, $semanticVersion, $operator);
	}

	/**
	 * @param $operator @see version_compare()
	 * @param $semanticVersion @see version_compare()
	 * @return bool
	 */
	public function adminVersionIs($operator, $semanticVersion): bool
	{
		try {
			$plugin = $this->grav['plugins']->get('admin');
			if (is_null($plugin)) {
				return false;
			}
			return version_compare($plugin->blueprints()->version, $semanticVersion, $operator);
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * Search the array for an item an returns the first one found.
	 * @param $array
	 * @param $filter
	 * @return mixed
	 */
	static public function array_find($filter, $array)
	{
		foreach ($array as $item) {
			if ($filter($item)) {
				return $item;
			}
		}
		return null;
	}

	/**
	 * @param Page $page
	 * @return string A route that points the user to a page's admin edit page.
	 */
	public function routeToEdit(Page $page): string
	{
		$route = $page->route();
		if ($route === '/') {
			$route = $page->rawRoute();
		}
		return $this->routeToAdmin() . '/pages' . $route;
	}

	/**
	 * @return string An absolute route that points to the admin base page.
	 */
	public function routeToAdmin(): string
	{
		$route = '/admin';
		$config = $this->grav['config'];
		$adminRoute = $config->get('plugins.admin', false);
		if ($adminRoute && isset($adminRoute['route'])) {
			$route = $adminRoute['route'];
		}

//		$base = isset($config->grav['base_url_relative']) ? $config->grav['base_url_relative'] : '';
		$base = rtrim($config->get('system.custom_base_url', ''), '/');
		return $base . $route;
	}
}
