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

require_once 'Grav/Common/Utils.php';
require_once 'classes/ServiceManager.php';
require_once 'classes/Net/LDAP2/Net_LDAP2_Filter.php';

class ServiceManagerFilterTest extends \Codeception\Test\Unit
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

    /**
     * @throws Exception
     */
    public function testServiceManagerFilter()
    {
        $manager = new ServiceManager();

        $manager->registerService('has-caption',
            ['fnGetCaption' => function () {
                return 'Caption 1';
            }],
            [
                'id' => 'c1',
                'group' => 'testing'
            ]);

        $manager->registerService('has-caption',
            ['fnGetCaption' => function () {
                return 'Caption 2';
            }],
            [
                'id' => 'c2',
                'group' => 'testing'
            ]);

        $service = $manager->findService('has-caption');
        $this->assertNotNull($service);
        $this->assertEquals("Caption 1", $service['fnGetCaption']());

        $service = $manager->findService('has-caption', '(id=c1)');
        $this->assertNotNull($service, "Service not found");
        $this->assertEquals("Caption 1", $service['fnGetCaption']());

        $service = $manager->findService('has-caption', '(id=c2)');
        $this->assertNotNull($service, "Service not found");
        $this->assertEquals("Caption 2", $service['fnGetCaption']());

        $services = $manager->findServices('has-caption', '(group=none)');
        $this->assertEquals(0, count($services));

        $services = $manager->findServices('has-none', '(group=id)');
        $this->assertEquals(0, count($services));

        $services = $manager->findServices('has-caption', '(group=testing)');
        $this->assertEquals(2, count($services));
    }

    public function testServiceManagerFilterBoolean()
    {
        $manager = new ServiceManager();

        $manager->registerService('is-int', 12, ['isEven' => true]);
        $manager->registerService('is-int', 13, ['isEven' => false]);

        $service = $manager->findService('is-int', '(isEven=TRUE)');
        $this->assertSame(12, $service);

        $service = $manager->findService('is-int', '(isEven=FALSE)');
        $this->assertSame(13, $service);
    }

    /**
     * @throws Exception
     */
    public function testServiceManagerFilterObjectClass()
    {
        $manager = new ServiceManager();

        $manager->registerService('is-int', 12, ['isEven' => true]);
        $manager->registerService('is-int', 13, ['isEven' => false]);

        $services = $manager->findServices(null, '(objectClass=is-int)');
        $this->assertSame(2, count($services));

        $services = $manager->findServices(null, '(&(objectClass=is-int)(isEven=FALSE))');
        $this->assertSame(1, count($services));
        $this->assertSame(13, $services[0]);
    }

    /**
     * @throws Exception
     */
    public function testServiceManagerFilterList()
    {
        $manager = new ServiceManager();

        $manager->registerService('is-int', 12, ['groups' => ['a', 'b', 'c']]);

        $services = $manager->findServices(null, '(&(objectClass=is-int)(groups=a))');
        $this->assertSame(1, count($services));

        $services = $manager->findServices(null, '(&(objectClass=is-int)(groups=a)(groups=b))');
        $this->assertSame(1, count($services));

        $services = $manager->findServices(null, '(&(objectClass=is-int)(groups=d))');
        $this->assertSame(0, count($services));
        
        $services = $manager->findServices(null, '(&(objectClass=is-int)(groups=a)(groups=d))');
        $this->assertSame(0, count($services));
    }

}