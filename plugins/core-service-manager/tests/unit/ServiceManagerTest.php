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
require_once "Init.php";

use Twelvetone\Common\ServiceManager;

//require_once 'Grav/Common/Utils.php';
require_once 'classes/ServiceManager.php';

class ServiceManagerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testRegisterService()
    {
        $manager = new ServiceManager();

        $manager->registerService('has-caption', ['caption' => 'c1']);
        $manager->registerService('has-caption', ['caption' => 'c2']);

        $services = $manager->getServices('has-caption');
        $this->assertEquals(2, count($services));
    }

    public function testIsEnabled()
    {
        $manager = new ServiceManager();

        $id = $manager->registerService('has-caption', ['caption' => 'c1', 'isEnabled' => false]);
        $service = $manager->getService($id);
        $this->assertTrue($manager->isVisible($service));
        $this->assertFalse($manager->isEnabled($service));
    }

    public function testIsVisible()
    {
        $manager = new ServiceManager();

        $id = $manager->registerService('has-caption', ['caption' => 'c1', 'isVisible' => false]);
        $service = $manager->getService($id);
        $this->assertFalse($manager->isVisible($service));
        $this->assertTrue($manager->isEnabled($service));
    }

    public function testIsEnabledFunction()
    {
        $manager = new ServiceManager();

        $id = $manager->registerService('has-caption', ['caption' => 'c1', 'isEnabled' => function () {
            return false;
        }]);
        $service = $manager->getService($id);
        $this->assertTrue($manager->isVisible($service));
        $this->assertFalse($manager->isEnabled($service));
    }

    public function testIsVisibleFunction()
    {
        $manager = new ServiceManager();

        $id = $manager->registerService('has-caption', ['caption' => 'c1', 'isVisible' => function () {
            return false;
        }]);
        $service = $manager->getService($id);
        $this->assertFalse($manager->isVisible($service));
        $this->assertTrue($manager->isEnabled($service));
    }
}