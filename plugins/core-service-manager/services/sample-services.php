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
if (\Grav\Common\Grav::instance()['config']->get("plugins.core-service-manager.show_samples", false)) {

    $manager = \Twelvetone\Common\ServiceManager::getInstance();

    $manager->registerService("renderer", [
        'render' => function () {
            return '<a class="button"><i class="fa fa-arrows"></i>All Scopes</a>';
        },
        'scope' => ['dashboard', 'pages', 'page', "configuration"],
        'order' => 'last'
    ]);

    $manager->registerService("renderer", [
        'render' => function () {
            return '<a class="button"><i class="fa fa-arrows"></i>Pages Scope</a>';
        },
        'scope' => ['pages'],
        'order' => 'last'
    ]);

    $manager->registerService("renderer", [
        'render' => function () {
            return '<a class="button"><i class="fa fa-arrows"></i>Page Scope</a>';
        },
        'scope' => ['page'],
        'order' => 'last'
    ]);

    $manager->registerService("renderer", [
        'render' => function () {
            return '<a class="button"><i class="fa fa-arrows"></i>Dashboard Scope</a>';
        },
        'scope' => ['dashboard'],
        'order' => 'last'
    ]);

    $manager->registerService("renderer", [
        'render' => function () {
            return '<a class="button"><i class="fa fa-arrows"></i>Configuration Scope</a>';
        },
        'scope' => ['configuration'],
        'order' => 'last'
    ]);

    $manager->registerService("admin:nav", [
        'item' => [
            'label' => 'Sample Item',
            'location' => 'dummy',
            'icon' => 'fa-arrows',
            'authorize' => 'admin.login',
            'badge' => [
                'count' => 12
            ]
        ],
        'scope' => ['dashboard', 'pages', 'page', "configuration"],
        'order' => 'last'

    ]);

    $manager->registerService("action", [
        'render' => function () {
            $twig = \Grav\Common\Grav::instance()['twig'];
            $params = [
                'items' => [
                    ['caption' => "Run", 'onclick' => 'alert("Run");'],
                    ['caption' => "Eat", 'onclick' => 'alert("Eat");'],
                    ['caption' => "Sleep", 'onclick' => 'alert("Sleep");'],
                ],
                'caption' => "Sample Action",
                'icon' => 'fa-arrows',

            ];
            return $twig->processTemplate('partials/nav-dropdown-menu.html.twig', $params);
        },
        'scope' => ["admin:sidebar"],
        'order' => 'last'
    ]);

//
// Menu items in the +Add page dropdown
//

    $manager->registerService("action", [
        'caption' => 'Sample Page',
        'scope' => ['page', 'pages'],
        'order' => 'last',
    ], [
        'menu' => 'page:add'
    ]);
}