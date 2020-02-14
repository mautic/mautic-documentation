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

        //
        // Report actions
        //

        $manager->registerService('action', [
            'caption' => 'Print',
            'icon' => 'fa-print',
            'order' => 'before:parent',
            'scope' => ['report'],
            'clientCallback' => 'Grav.default.Utils.toastr.warning("Print Not Implemented");',
//        'serverCallbackId' => 'reports:print',
//        'serverCallback' => function ($context) {
//            die('not implemented');
//        }
        ]);
        $manager->registerService('action', [
            'caption' => 'Download',
            'icon' => 'fa-download',
            'order' => 'before:parent',
            'scope' => ['report'],
            'clientCallback' => 'Grav.default.Utils.toastr.warning("Download Not Implemented");',
//        'serverCallbackId' => 'reports:print',
//        'serverCallback' => function ($context) {
//            die('not implemented');
//        }
        ]);
        $manager->registerService('action', [
            'caption' => 'EMail',
            'icon' => 'fa-envelope',
            'order' => 'before:parent',
            'scope' => ['report'],
            'clientCallback' => 'Grav.default.Utils.toastr.warning("Email Not Implemented");',
//        'serverCallbackId' => 'reports:print',
//        'serverCallback' => function ($context) {
//            die('not implemented');
//        }
        ]);

        $manager->registerService('action', [
            'caption' => 'Help',
            'icon' => 'fa-question-circle',
            'order' => 'before:parent',
            'scope' => ['report', 'reportlist'],
            'clientCallback' => 'window.open("https://www.twelvetone.tv/docs/developer-tools/grav-plugins/grav-admin-power-tools#reports", "_blank");',
        ]);
        
    }
}
