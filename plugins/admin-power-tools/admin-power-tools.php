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

namespace Grav\Plugin;

use Grav\Common\Data\Blueprints;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Plugin;
use Grav\Common\Utils;
use RocketTheme\Toolbox\Event\Event;
use Twelvetone\Common\AdminPowerTools\DependencyUtil;
use Twelvetone\Common\ServiceManager;

include_once "classes/MarkdownTools.php";
include_once "classes/DependencyUtil.php";

/**
 * Class AdminPowerToolsPlugin
 * @package Grav\Plugin
 */
class AdminPowerToolsPlugin extends Plugin
{
	public static function getSubscribedEvents()
	{
		return [
			'onPluginsInitialized' => ['onPluginsInitialized', 0],
			'onBlueprintCreated' => ['onBlueprintCreated', 0]
		];
	}

	public function onPluginsInitialized()
	{
		if (!DependencyUtil::checkDependencies($this)) {
			return;
		}

		$manager = ServiceManager::getInstance();

		//
		// ASSETS
		//

		$manager->registerService("asset", [
			"type" => 'css',
			"url" => "plugins://admin-power-tools/assets/scroll_fix.css",
			"scope" => ["all"],
			"order" => "last",
		]);

		if (!$this->isAdmin()) {
			$this->enable([
				'onPageContentRaw' => ['onPageContentRaw', 0],
				'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
				'onTwigInitialized' => ['onTwigInitialized_site', 0],
			]);
		} else {
			$this->enable([
				'onAdminTaskExecute' => ['onAdminTaskExecute', 0],
				'onAdminTaskExecute_Fix' => ['onAdminTaskExecute', 0],
				'onTwigExtensions' => ['onTwigExtensions', 0],
				'onTwigInitialized' => ['onTwigInitialized', 0],
				'onPageNotFound' => ['onPageNotFound', 1],
				'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
				'onAdminAfterSave' => ['onAdminAfterSave', 0],
			]);

			$manager = ServiceManager::getInstance();
			$manager->requireServices(__DIR__ . "/services");

			//
			// CSS
			//

			// This breaks dropdown actions (overflow-y:visible not working)
//            $manager->registerService("asset", [
//                "type" => "css",
//                "url" => 'plugin://admin-power-tools/assets/titlebar_fix.css'
//            ]);

		}
	}

	public function onAdminTwigTemplatePaths($event)
	{
		$event['paths'] = array_merge($event['paths'], [__DIR__ . '/admin/templates']);
		return $event;
	}

	public function onTwigTemplatePaths()
	{
		$this->grav['twig']->twig_paths[] = __DIR__ . '/site/templates';
	}


	public function onTwigInitialized()
	{
		$twig = $this->grav['twig']->twig;
		$twig->addFunction(new \Twig_SimpleFunction("get_page_section", [$this, "get_page_section"]));
	}

	public function onTwigInitialized_site()
	{
		$twig = $this->grav['twig']->twig;
		$twig->addFunction(new \Twig_SimpleFunction("child_page_list", [$this, "child_page_list"]));
	}

	public function onTwigExtensions()
	{
		$twig = $this->grav['twig']->twig;
		$twig->addFunction(new \Twig_SimpleFunction('getPages', [$this, 'getPages']));

		require_once "services/_nav-up-service.php";
	}

	public function get_page_section($route, $section)
	{
		if ($route == '') {
			$route = '/';
		}
		$page = $this->grav['pages']->find($route);
		if (!$page) {
			return null;
		}
		$content = $page->rawMarkdown();

		return \MarkdownTools::getSectionContents($content, $section);
	}

	public function child_page_list()
	{
		$page = $this->grav['page'];
		return $this->grav['twig']->processTemplate('partials/child-pages.html.twig', ['page' => $page]);
	}

	public function onPageNotFound($e)
	{
		if (!$this->isAdmin()) {
			return;
		}

		// As of Grav 1.7, the pages are not present unless this is called
		if (method_exists($this->grav['admin'], 'enablePages')) {
			$this->grav['admin']->enablePages();
		}

//		$adminBase = $this->grav['uri']->rootUrl(false) . '/' . trim($this->grav['admin']->base, '/');
		$route = '/' . $this->grav['admin']->location . "/" . $this->grav['admin']->route;
		if (Utils::startsWith($route, "/powertools/edit-section")) {
			if (preg_match("#/powertools/edit-section(.*)#", $route, $m)) {
				$page = new Page;
				$page->init(new \SplFileInfo(__DIR__ . "/pages-internal/edit-section.md"));

				$route = $m[1];
				if (Utils::startsWith($route, '/')) {
					$route = substr($route, 1);
				}
				$this->grav['session']->setFlashObject("route", "/" . $route);
				$this->grav['session']->setFlashObject("section", $_GET['section']);
				$this->grav['session']->setFlashObject("section_name", \MarkdownTools::getSectionName($_GET['section']));
				$this->grav['session']->setFlashObject("section_level", \MarkdownTools::getSectionLevel($_GET['section']));
//                $decodedPage = urldecode($m[1]);
//                $decodedSection = urldecode($m[2]);
//                $this->grav['session']->setFlashObject("route", $decodedPage);
//                $this->grav['session']->setFlashObject("section", $decodedSection);
//                $this->grav['session']->setFlashObject("section_name", \MarkdownTools::getSectionName($decodedSection));
//                $this->grav['session']->setFlashObject("section_level", \MarkdownTools::getSectionLevel($decodedSection));
//                $this->grav['session']->setFlashObject("route", "/" . $m[1]);

				$e->page = $page;
				$e->stopPropagation();
			}
		} else {
			switch ($route) {
				case "/powertools/delete-section":
					$route = $_POST['route'];
					$section = $_POST['section'];
					$targetPage = $this->grav['pages']->find($route);

					$page = new Page;
					$page->template('admin-raw');

					if (!$targetPage) {
						$page->rawMarkdown('NOT FOUND');
					} else {
						$newContent = \MarkdownTools::removeSection($targetPage->rawMarkdown(), $section);
						$targetPage->rawMarkdown($newContent);
						$this->grav['core-service-util']->save($targetPage);
						$page->rawMarkdown("OK");
//                        $page->rawMarkdown($newContent);
					}
					$e->page = $page;
					$e->stopPropagation();
					break;
				case "/powertools/save-section":
					//TODO implement
					$route = $_POST['route'];
					$section = $_POST['section'];
					$newSection = $_POST['content'];
					$newSectionName = $_POST['section_name'];
					$targetPage = $this->grav['pages']->find($route);

					$page = new Page;
					$page->template('admin-raw');

					if (!$targetPage) {
						$page->rawMarkdown('NOT FOUND');
					} else {
						$newContent = \MarkdownTools::replaceSection($targetPage->rawMarkdown(), $section, $newSectionName, $newSection);
						$targetPage->rawMarkdown($newContent);
						$this->grav['core-service-util']->save($targetPage);
						$page->rawMarkdown("OK");
//                        $page->rawMarkdown($newContent);
					}
					$e->page = $page;
					$e->stopPropagation();
					break;
			}
		}
	}


	public function onAdminTaskExecute($e)
	{
		$method = $e['method'];
		if (!Utils::startsWith($method, "task")) {
			return false;

		}
		$taskName = substr($method, 4);
		$taskName = mb_strtolower($taskName);

		$this->grav['admin']->enablePages();

		switch ($taskName) {
			case "copy-page-custom":
				$data = $_POST['data'];

				$like = $data['page_like'];
				$title = $data['title'];
				$folder = $data['folder'];

				$likePage = $this->grav['pages']->find($like);
				if ($title == '') {
					$title = $likePage->title();
				}

				if ($folder == "") {
					$folder = \Grav\Plugin\Admin\Utils::slug($title);
				}
				$slug = \Grav\Plugin\Admin\Utils::slug($folder);
				$order = \Grav\Plugin\Admin\AdminController::getNextOrderInFolder($likePage->parent()->path());
				if (preg_match(PAGE_ORDER_PREFIX_REGEX, basename($likePage->path()))) {
					$use_order = true;
				} else {
					$use_order = false;
				}

				$newPage = $likePage->copy($likePage->parent());
				$newPage->header()->title = $title;

				//TODO message
				if ($likePage->parent()->find("/$slug")) {
					$slugNew = AdminPowerToolsPlugin::getUniqueSlug($likePage->parent(), $slug);

					if ($use_order) {
						$newPage->path($newPage->parent()->path() . '/' . sprintf("%02d", $order) . '.' . $slugNew);
					} else {
						$newPage->path($newPage->parent()->path() . '/' . $slugNew);
					}
					$newPage->route($newPage->parent()->route() . '/' . $slugNew);
					$newPage->rawRoute($newPage->parent()->rawRoute() . '/' . $slugNew);

				} else {
					if ($use_order) {
						$newPage->path($newPage->parent()->path() . DS . sprintf("%02d", $order) . '.' . $folder);
					} else {
						$newPage->path($newPage->parent()->path() . '/' . $folder);
					}
					$newPage->route($newPage->parent()->route() . '/' . $slug);
					$newPage->rawRoute($newPage->parent()->rawRoute() . '/' . $slug);
				}

				if ($e['copy_clear_content']) {
					$newPage->rawMarkdown("");
				}

				$util = $this->grav['core-service-util'];
				$util->save($newPage);
				$this->grav->redirect($util->routeToEdit($newPage->route()));
				break;

			case "new-page-custom-parent":
			case "new-page-custom-child":
			case "new-page-custom-this":
			case "new-page-custom":
			case "new-page-child":
				$data = $_POST['data'];

				if ($data['use_media']) {
					//TODO we still need to respect settings
					// We need to create the page, so do copy instead
					$e["method"] = "taskCopy-page-custom";

					if (!$data['use_content']) {
						$e["copy_clear_content"] = true;
					}

					return $this->onAdminTaskExecute($e);
				}

				$like = $data['page_like'];
				$title = $data['title'];

				$likePage = $this->grav['pages']->find($like);

				if ($method === "taskNew-page-child") {
					$parentRoute = $likePage->route();
				} else {
					if ($likePage->parent()) {
						$parentRoute = $likePage->parent()->route();
					} else {
						$parentRoute = "";
					}
				}

				if ($title === "") {
					$slug = $likePage->slug();
				} else {
					$slug = \Grav\Plugin\Admin\Utils::slug($title);
				}
				$slug = AdminPowerToolsPlugin::getUniqueSlug($likePage->parent(), $slug);

				$route = $parentRoute . '/' . $slug;

				$session = $this->grav['session'];
				if ($data['use_content']) {
					$session->setFlashObject("use_content", $likePage->rawMarkdown());
				} else {
					$session->setFlashObject("use_content", "");
				}

				if ($data['use_title']) {
					$session->setFlashObject("use_title", $likePage->title());
				} else {
					$session->setFlashObject("use_title", $title);
				}

//                if ($data['use_body_classes']) {
//                    $session->setFlashObject("use_body_classes", $likePage->header()->body_classes);
//                } else {
//                    $session->setFlashObject("use_body_classes", "");
//                }

				if ($data['use_taxonomy']) {
					$session->setFlashObject("use_taxonomy", $likePage->taxonomy());
				} else {
					$session->setFlashObject("use_taxonomy", []);
				}

//                if ($data['use_body_classes']) {
//                    if (isset($likePage->header()->body_classes)) {
//                        $session->setFlashObject("use_body_classes", $likePage->header()->body_classes);
//                    } else{
//                        $session->setFlashObject("use_body_classes", "");
//                    }
//                } else {
//                    $session->setFlashObject("use_body_classes", "");
//                }

				$session->setFlashObject("like_page", $likePage);
				$session->setFlashObject("like_data", $data);
				$session->setFlashObject("add_page_enabled", true);
				$util = $this->grav['core-service-util'];
				$this->grav->redirect($util->routeToEdit($route));

				if (false) {
					$route = $data['route'] != '/' ? $data['route'] : '';
					$folder = $data['folder'];
					// Handle @slugify-{field} value, automatically slugifies the specified field
					if (substr($folder, 0, 9) == '@slugify-') {
						$folder = \Grav\Plugin\Admin\Utils::slug($data[substr($folder, 9)]);
					}
					$folder = ltrim($folder, '_');
					if (!empty($data['modular'])) {
						$folder = '_' . $folder;
					}
					$path = $route . '/' . $folder;

					$this->admin->session()->{$path} = $data;

					// Store the name and route of a page, to be used pre-filled defaults of the form in the future
					$this->admin->session()->lastPageName = $data['name'];
					$this->admin->session()->lastPageRoute = $data['route'];
					$this->setRedirect("{$this->view}/" . ltrim($path, '/'));
				}
				return true;
			case 'move-page-custom':
				$data = $_POST['data'];
				$parentPageId = get($data, 'parentPageId', null);
				if (!$parentPageId) {
					die("Target page not specified");
				}
				$sourceRoute = get($data, 'sourceRoute', null);
				if (!$sourceRoute) {
					die("Source route not specified");
				}
				if ($parentPageId == "(root)") {
					$parentPage = $this->grav['pages']->root();
				} else {
					$parentPage = $this->getPageById($parentPageId);
					if (!$parentPage) {
						die("Target page not found");
					}
				}
				$sourcePage = $this->grav['pages']->find("/" . $sourceRoute);
				if (!$sourcePage) {
					die("Source page not found");
				}
				if ($parentPage == null || $sourcePage->id() !== $parentPage->id()) {
					$sourcePage->move($parentPage);
					$this->grav['core-service-util']->save($sourcePage);
					$routeToEdit = $this->grav['core-service-util']->routeToEdit($sourcePage);
					$this->grav->redirect($routeToEdit);
				}

				return true;

			default:
				return false;
		}
	}

	private function getPageById($pageId)
	{
		$allPages = $this->grav['pages']->instances();
		foreach ($allPages as $page) {
			if ($page->id() == $pageId) {
				return $page;
			}
		}
		return null;
	}

	public function onPageContentRaw($e)
	{
		$adminCookie = session_name() . '-admin';
		if (isset($_COOKIE[$adminCookie]) === false) {
			return;
		}

		$page = $e['page'];
		if (!isset($page->header()->editable) || $page->header()->editable === true) {
			// Add an edit-page link to bottom of page
			$content = $page->getRawContent();

			if ($this->config->get("plugins.admin-power-tools.edit_page_enabled", true)) {
				$path = $this->grav['uri']->path();
				if ($path == '/') {
					$page = $this->grav['pages']->find('/');
					if ($page) {
						$path = "/" . $page->slug();
					}
				}
				$util = $this->grav['core-service-util'];
				$routeToEdit = $util->routeToEdit($page);
				$content .= "\n\n[Edit Page On Grav](" . $routeToEdit . "?target=_blank)";
			}

			if ($this->config->get("plugins.admin-power-tools.edit_section_enabled", true)) {
				$util = $this->grav['core-service-util'];
				$href = $util->routeToAdmin() .  "/powertools/edit-section" . $page->route();

				//WORKAROUND see https://github.com/getgrav/grav/issues/2964
				if (substr($href, -1) == '/') {
					$href = substr($href, 0, -1);
				}
				if ($href === '/') {
					$href = '';
				}
				//WORKAROUND end

				$content = preg_replace_callback("~^(#+\s*.*)$~m", function ($m) use ($href) {
					$s = urlencode($m[1]);
					return "$m[0]&nbsp;<a href='$href?section=$s'><i class='fa fa-edit' style='font-size:initial' title='Edit Section'></i></a>";
				}, $content);
			}

			$page->setRawContent($content);
		}

	}

	static function getUniqueSlug($parentPage, $slug)
	{
		if (!$parentPage->find("/$slug")) {
			return $slug;
		}
		// remove the number at the end
		$slugBase = preg_replace("#-?\d+$#", "", $slug);
		$i = 1;
		$slugNew = $slugBase . "-$i";
		while ($parentPage->find("/$slugNew")) {
			$i++;
			$slugNew = $slugBase . "-$i";
		}
		return $slugNew;
	}

	function onAdminAfterSave($event)
	{
		if (!isset($_POST['data'])) {
			return;
		}
		$data = $_POST['data'];
		if (isset($data['order-child'])) {
			$parentPage = $event['object'];
			$strOrder = $data['order-child'];
			if (!empty($strOrder)) {
				$pageOrder = explode(',', $strOrder);
				self::_doReorder($parentPage, $pageOrder);
			}
		}
	}

	public function onBlueprintCreated(Event $event)
	{
		if (!DependencyUtil::checkDependencies($this)) {
			return;
		}

		if ($this->config->get(' child_reordering_immediate', true)) {
			static $inEvent = false;
			/** @var \Grav\Common\Data\Blueprint $blueprint */
			$blueprint = $event['blueprint'];
			if (!$inEvent && $blueprint->get('form/fields/tabs', null, '/')) {
				$inEvent = true;
				$blueprints = new Blueprints(__DIR__ . '/blueprints');
				$extends = $blueprints->get('child-pages');
				$blueprint->extend($extends, true);
				$inEvent = false;
			}
		}
	}

	public function getPages()
	{
		$page = $this->grav['page'];
		$ret = [];
		$pages = $page->evaluate("@root.descendants");

		array_push($ret, ['label' => '(root)', 'value' => "(root)", "id" => "", "route" => "*"]);

		foreach ($pages as $p) {
			array_push($ret, [
				// for combo
				'label' => $p->title(),
				'value' => $p->id(),
				// for others
				'id' => $p->id(),
				'route' => $p->route()
			]);
		}
		return $ret;
	}

	/**
	 * @param $parentPage Page
	 * @param $pageOrder array
	 */
	static public function _doReorder($parentPage, $pageOrder)
	{
		$grav = Grav::instance();
		$childPage = $grav['pages']->find($parentPage->route() . "/" . $pageOrder[0]);
		if ($childPage) {
			$childPage = $childPage->move($childPage->parent());
			$childPage->save($pageOrder);
			$grav['messages']->add("Child pages reordered", 'info');
		}
	}
}


//// remove the number at the end
//$fileBase = preg_replace("#^\d+#", "", $newPage->path());
//$fileBase = preg_replace("#-?\d+$#", "", $fileBase);
//$i = 0;
//$fileNew = $fileBase . "-$i";
//while (file_exists($fileNew)) {
//    $i++;
//    $fileNew = $fileBase . "-$i";
//
//}
//$newPage->path($fileNew);
