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

use Twelvetone\Common\ServiceManager;

{
    $manager = ServiceManager::getInstance();
    $config = \Grav\Common\Grav::instance()['config'];
    $grav = \Grav\Common\Grav::instance();

    $manager->registerService("asset", [
        'type' => 'js',
        'url' => 'plugin://admin-power-tools/vendor/bundle.js',
        'order' => 1000,
        'isEnabled' => function () {
            return \Grav\Common\Grav::instance()['config']->get('plugins.admin-power-tools.child_reordering_enabled', true);
        }
    ]);

    $manager->registerService("asset", [
        'type' => 'js',
        'url' => 'plugin://admin-power-tools/assets/page_order.js',
        'order' => -1000,
        'isEnabled' => function () {
            return \Grav\Common\Grav::instance()['config']->get('plugins.admin-power-tools.child_reordering_enabled', true);
        }
    ]);

    $manager->registerService("asset", [
        'type' => 'js',
        'url' => 'plugin://admin-power-tools/assets/ajax_util.js',
        'order' => 0,
        'isEnabled' => function () {
            return
                \Grav\Common\Grav::instance()['config']->get('plugins.admin-power-tools.child_reordering_enabled', true) &&
                \Grav\Common\Grav::instance()['config']->get('plugins.admin-power-tools.child_reordering_immediate', true);
        }
    ]);

    if ($config->get('plugins.admin-power-tools.child_reordering_enabled', true)) {
        if ($config->get('plugins.admin-power-tools.child_reordering_immediate', true)) {
            $manager->registerService("page", [
                'scope' => ['admin'],
                'rxroute' => "/powertools/reorder",
                'getPage' => function () use ($grav) {
                    {
                        $parentRoute = $_POST['parentRoute'];
                        $parentPage = $grav['pages']->find('/' . $parentRoute);
                        if (!$parentPage) {
                            throw new Exception(("Parent page not found for route: $parentPage"));
                        }
                        $order = explode(',', $_POST['childOrder']);
                        \Grav\Plugin\AdminPowerToolsPlugin::_doReorder($parentPage, $order);
                        die("OK");
                    }
                }
            ]);
        }
    }

}