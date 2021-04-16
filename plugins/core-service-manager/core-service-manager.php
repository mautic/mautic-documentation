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

use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Common\Utils;
use RocketTheme\Toolbox\Event\Event;
use Twelvetone\Common\ServiceManager;

require_once "classes/ServiceManager.php";
require_once 'classes/DependencyUtil.php';
require_once 'classes/CoreServiceUtil.php';

/**
 * Class CoreServiceManagerPlugin
 * @package Grav\Plugin
 */
class CoreServiceManagerPlugin extends Plugin
{
	public function __construct($name, Grav $grav, Config $config = null)
	{
		parent::__construct($name, $grav, $config);
		$util = new CoreServiceUtil($grav);
		$grav['core-service-util'] = $util;
	}

	public static function getSubscribedEvents()
	{
		return [
			'onPluginsInitialized' => ['onPluginsInitialized', 0],
		];
	}

	public function onAssetsInitialized()
	{
		$a = $this->grav['assets'];

		function addAsset($a, &$service)
		{
			if (!ServiceManager::getInstance()->isEnabled($service)) {
				return;
			}

			switch ($service['type']) {
				case 'css':
				{
					$a->addCss($service['url']);
					break;
				}
				case 'js':
				case 'javascript':
				{
					if (isset($service['order']) && is_numeric($service['order'])) {
						$a->addJs($service['url'], $service['order'], false);
					} else {
						$a->addJs($service['url']);
					}
					break;
				}
			}
		}

		$manager = ServiceManager::getInstance();

		foreach ($manager->getServices("asset") as $service) {
			addAsset($a, $service);
		}
		$manager->registerServiceListener('asset', function ($serviceInfo) use ($a) {
			addAsset($a, $serviceInfo->implementation);
		});


		require_once "services/sample-services.php";
		require_once "services/dependency-report.php";
		//TODO not working (class not found issues)
		//ServiceManager::getInstance()->requireServices(__DIR__ . "/services");
	}

	public function onPluginsInitialized()
	{
		if (!$this->isAdmin()) {
			$this->enable([
				'onAssetsInitialized' => ['onAssetsInitialized', 0],
			]);
			return;
		}

		$toEnable = [
			'onAssetsInitialized' => ['onAssetsInitialized', 0],
			'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
			'onTwigExtensions' => ['onTwigExtensions', 0],
			'onPageNotFound' => ['onPageNotFound', 1],
			'onAdminTaskExecute' => ['onAdminTaskExecute', 0],
		];

		if ($this->grav['core-service-util']->adminVersionIs('>=', '1.10')) {
			$toEnable['flex.pages.admin.route'] = ['onAdminRoute', 0];
			$toEnable['onAdminTaskExecute_Fix'] = ['onAdminTaskExecute', 0];
		}
		$this->enable($toEnable);

		ServiceManager::getInstance()->registerService("asset", [
			"type" => "js",
			"url" => 'plugin://core-service-manager/assets/modal.js'
		]);

		ServiceManager::getInstance()->registerService("asset", [
			"type" => "css",
			"url" => 'plugin://core-service-manager/assets/modal.css'
		]);

		ServiceManager::getInstance()->registerService("asset", [
			"type" => "js",
			"url" => 'plugin://core-service-manager/assets/ajax_action.js'
		]);

		ServiceManager::getInstance()->registerService("asset", [
			"type" => "js",
			"url" => 'plugin://core-service-manager/assets/ajax.js'
		]);

		ServiceManager::getInstance()->registerService("asset", [
			"type" => "js",
			"url" => 'plugin://core-service-manager/assets/ajax_action.js'
		]);

		ServiceManager::getInstance()->registerService("asset", [
			"type" => "css",
			"url" => 'plugin://core-service-manager/assets/core.css'
		]);
	}

	public function onAdminTwigTemplatePaths($event)
	{
		$is_1_7 = version_compare(GRAV_VERSION, "1.7.0-beta.8", ">=");

		if ($this->config->get("plugins.core-service-manager.override_admin_twigs", true)) {
			$grav = Grav::instance();
			$plugins = $grav['plugins'];
			$plugin = $plugins->get('admin');
			if ($plugin) {
				$version = $plugin->blueprints()->version;
				$admin_is_1_8 = version_compare($version, '1.10.0-beta.8') >= 0;
				$version = preg_replace('/-beta.*$/', '', $version);
				if ($is_1_7 && $admin_is_1_8) {
					$event['paths'] = array_merge([__DIR__ . '/templates/grav-1.7/admin-latest'], $event['paths']);
				} else if (version_compare($version, '1.9.0') < 0) {
					$event['paths'] = array_merge($event['paths'], [__DIR__ . '/templates/grav-1.6/admin-1.9']);
				} else if (version_compare($version, '1.10.0') < 0) {
					$event['paths'] = array_merge($event['paths'], [__DIR__ . '/templates/grav-1.6/admin-1.10']);
				} else {
					$event['paths'] = array_merge($event['paths'], [__DIR__ . '/templates/grav-1.6/admin-latest']);
				}
			}
		}
		$event['paths'] = array_merge($event['paths'], [__DIR__ . '/templates/twelvetone']);

		return $event;
	}

	public function onAdminRoute(Event $event): void
	{
		if ($this->grav['core-service-util']->adminVersionIs('<', '1.10')) {
			return;
		}
		//WORKAROUND The FlexObjects plugin intercepts admin routes,
		//so onAdminTaskExecute is never called for task posts.
		if (!isset($_POST['task'])) {
			return;
		}

		//TODO check nonce
		//$nonce = $_POST['admin-nonce'];

		$task = $_POST['task'];
		$e = new Event([
			'controller' => null, //TODO set controller
			'method' => 'task' . $task,
			'isWorkaround' => true,
		]);
		$this->grav->fireEvent('onAdminTaskExecute_Fix', $e);
	}

	public function onTwigExtensions()
	{
		require_once(__DIR__ . '/twig/service-twig-extensions.php');
		$twig = $this->grav['twig']->twig;

		$twig->addExtension(new ServiceTwigExtensions());
	}

	public function onAdminTaskExecute($e)
	{
		$method = $e['method'];
		if (!Utils::startsWith($method, 'task')) {
			return false;

		}
		$taskName = substr($method, 4);
		$taskName = mb_strtolower($taskName);

		$found = CoreServiceUtil::array_find(function ($service) use ($taskName) {
			return $service['name'] == $taskName;
		}, ServiceManager::getInstance()->getServices('task'));

		if (!$found) {
			return false;
		}
		$found['execute']();
		return true;
	}

	public function onPageNotFound($e)
	{
		$route = "/" . $this->grav['admin']->location . "/" . $this->grav['admin']->route;

		$pageServices = ServiceManager::getInstance()->getServices('page');
		foreach ($pageServices as $pageService) {
			if (!in_array("admin", $pageService['scope'])) {
				continue;
			}
			//TODO escape tildes
			if (preg_match('~' . $pageService['rxroute'] . '~', $route)) {
				$page = $pageService['getPage']($route);
				$e->page = $page;
				$e->stopPropagation();
				return true;
			}
		}

		switch ($route) {
			case "/core-service-manager/ajax_action":
				$actionId = $_POST['actionId'];
				$context = $_POST['context'];
				ServiceManager::getInstance()->onAjaxAction($actionId, $context);
				die('');

			case "/core-service-manager/non_ajax_action":
				$actionId = $_POST['actionId'];
				$context = $_POST['context'];
				ServiceManager::getInstance()->onNonAjaxAction($actionId, $context);
				die('');

			default:
				return false;
		}
	}
}
