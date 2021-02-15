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
/**
 * Service Manager
 * A simple manager for registering objects by name.
 */

namespace Twelvetone\Common;

use Grav\Common\Grav;

require_once "ServiceInfo.php";
require_once "Net/LDAP2/Net_LDAP2_Filter.php";

class ServiceManager
{
    private static $instance;

    private $nextServiceId = 1000;
    private $serviceMap = []; // serviceName => serviceInfo[]
    private $serviceInfoMap = []; // serviceId => serviceInfo
    private $listenerMap = [];

    //TODO object should have factory option to delay creation
    //TODO object by reference

    /**
     * @return ServiceManager
     */
    static function getInstance()
    {
        if (!ServiceManager::$instance) {
            ServiceManager::$instance = new ServiceManager();
        }
        return ServiceManager::$instance;
    }

    /**
     * @param $name string The service name
     * @param $theService mixed The service as an array, object, boolean, string, number, or factory closure
     * @param $properties array Properties to associate with the object
     * @return int The serviceId
     */
    public function registerService($name, $theService, $properties = [])
    {
        $serviceId = $this->nextServiceId++;

        if (!isset($this->serviceMap[$name])) {
            $this->serviceMap[$name] = [];
        }

        $properties['_SERVICE_ID'] = $serviceId;
        $properties['objectClass'] = $name;
        if (is_array($theService) && isset($theService['scope'])) {
            $properties['scope'] =& $theService['scope'];
        }

        $serviceInfo = new ServiceInfo([
            'service' => $name,
            'serviceId' => $serviceId,
            'implementation' => &$theService,
            'properties' => &$properties,
            'entries' => \Net_LDAP2_Entry::createFresh('local', $properties),
        ]);

        $this->serviceMap[$name][] = $serviceInfo;
        $this->serviceInfoMap[$serviceId] = $serviceInfo;

        //TODO this should be in a listener
        if (\Grav\Common\Utils::startsWith($name, "admin:")) {
            $theService['order'];
            $theService['scope'];
        }
        if ($name === "renderer") {
            $theService['order'];
            $theService['scope'];
        }
        if ($name === "action") {
            $theService['order'];
            $theService['scope'];
        }

        //TODO this should be in a listener
        switch ($name) {
            case "admin:nav":
                $twig = Grav::instance()['twig'];
                $twig->plugins_hooked_nav = (isset($twig->plugins_hooked_nav)) ? $twig->plugins_hooked_nav : [];
                $nav = &$theService;
                $twig->plugins_hooked_nav[$nav['item']['label']] = $nav['item'];
                break;
        }

        $this->notifyListeners($name, $serviceInfo);

        return $serviceId;
    }

    /**
     * @param string $serviceName
     * @param callable string,array $listener
     * @param bool|null $fireOnExisting If true, the listener will be invoked for existing items
     */
    public function registerServiceListener($serviceName, $listener, $fireOnExisting = false)
    {
        if (!isset($this->listenerMap[$serviceName])) {
            $this->listenerMap[$serviceName] = [];
        }
        $this->listenerMap[$serviceName][] = $listener;

        if ($fireOnExisting) {
            if (isset($this->serviceMap[$serviceName])) {
                foreach ($this->serviceMap[$serviceName] as $serviceInfo) {
                    $this->notifyListeners($serviceName, $serviceInfo);
                }
            }
        }
    }

    public function unregisterServiceListener($serviceName, $listener)
    {
        if (isset($this->listenerMap[$serviceName])) {
            if (($key = array_search($listener, $this->listenerMap[$serviceName])) !== false) {
                unset($this->listenerMap[$serviceName][$key]);
            }
        }
    }

    public function &getAllServiceInfos()
    {
        return $this->serviceMap;
    }

    public function getServiceIds()
    {
        return array_keys($this->serviceInfoMap);
    }

    public function getServiceInfo($serviceId)
    {
        return $this->serviceInfoMap[$serviceId];
    }

    public function getServiceProperties($serviceId)
    {
        return $this->serviceInfoMap[$serviceId]['properties'];
    }

    public function getServices($name)
    {
        if (!isset($this->serviceMap[$name])) {
            return [];
        } else {
            $items = &$this->serviceMap[$name];
            return array_map(function ($a) {
                return $a->implementation;
            }, $items);
        }
    }

    public function getServiceInfos($name)
    {
        if (!isset($this->serviceMap[$name])) {
            return [];
        } else {
            return $this->serviceMap[$name];
        }
    }

    private function findServiceForAction($actionId)
    {
        $found = current(array_filter($this->getServices('action'),
            function ($a) use ($actionId) {
                return isset($a['serverCallbackId']) && $a['serverCallbackId'] === $actionId;
            }
        ));
        return $found;
    }

    public function onAjaxAction($actionId, $context)
    {
        $found = $this->findServiceForAction($actionId);
        if ($found) {
            $found['serverAsyncCallback']($context);
        }
    }

    public function onNonAjaxAction($actionId, $context)
    {
        //TODO log if service is not found, or handler is not installed
        $found = $this->findServiceForAction($actionId);
        if ($found) {
            $value = json_decode($context, true);
            if (isset($found['serverHandler'])) {
                $found['serverHandler']($value);
            } else {
                $found['serverCallback']($value);
            }
        }
    }

    /**
     * @param mixed $service
     * @param mixed $context
     * @return bool false if service has an isEnabled() function that returns falsy.  True otherwise.
     */
    public function isEnabled(&$service, $context = null)
    {
        if (!is_array($service)) {
            return true;
        }
        if (!isset($service['isEnabled'])) {
            return true;
        }
        if (is_callable($service['isEnabled'])) {
            return $service['isEnabled']($context);
        } else {
            return (boolean)$service['isEnabled'];
        }
    }

    /**
     * @param mixed $service
     * @param mixed $context
     * @return bool false if service has an isVisible() function that returns falsy.  True otherwise.
     */
    public function isVisible(&$service, $context = null)
    {
        if (!is_array($service)) {
            return true;
        }
        if (!isset($service['isVisible'])) {
            return true;
        }
        if (is_callable($service['isVisible'])) {
            return $service['isVisible']($context);
        } else {
            return (boolean)$service['isVisible'];
        }
    }

    /**
     * Performs a require_once on all php files in directory that do not start with an underscore.
     *
     * @param $dir string
     */
    public function requireServices($dir)
    {
        foreach (scandir($dir) as $file) {
            if (preg_match('#[^_].*\\.php#', $file)) {
                require_once "$dir/$file";
            }
        }
    }

    public function getService($serviceId)
    {
        return $this->serviceInfoMap[$serviceId]->implementation;
    }

    public function ungetService($serviceId)
    {
    }

    /**
     * @param string $serviceName The service name.
     * @param string $ldapFilter
     * @return array|null
     * @throws \Exception
     */
    public function findService($serviceName, $ldapFilter = null)
    {
        $ret = $this->findServiceInfo($serviceName, $ldapFilter);
        if (!$ret) {
            return null;
        }
        return $ret->implementation;
    }

    /**
     * @param string $serviceName The service name
     * @param string $ldapFilter
     * @return ServiceInfo|null
     * @throws \Exception
     */
    public function findServiceInfo($serviceName, $ldapFilter = null)
    {
        if ($serviceName == null && $ldapFilter == null) {
            throw new \Exception("No filter specified");
        }

        if ($serviceName != null) {
            if (!isset($this->serviceMap[$serviceName])) {
                return null;
            }

            if ($ldapFilter == null) {
                $items = &$this->serviceMap[$serviceName];
                $serviceInfo = reset($items);
                if (!$serviceInfo) {
                    return null;
                }
                return $serviceInfo;
            }
        }

        $filter = \Net_LDAP2_Filter::parse($ldapFilter);
        if (\MYPEAR::isError($filter)) {
            throw new \Exception($filter);
        }
        foreach ($this->serviceInfoMap as $serviceInfo) {
            if ($filter->matches($serviceInfo->entries) > 0) {
                return $serviceInfo;
            }
        }
        return null;
    }

    /**
     * @param string $serviceName The service name
     * @param string $ldapFilter
     * @return array|null
     * @throws \Exception
     */
    public function findServices($serviceName, $ldapFilter = null)
    {
        if ($serviceName == null && $ldapFilter == null) {
            throw new \Exception("No filter specified");
        }

        if ($serviceName != null) {
            if (!isset($this->serviceMap[$serviceName])) {
                return [];
            }
            if ($ldapFilter == null) {
                $items = $this->serviceMap[$serviceName];
                return $items;
            }
        }

        $found = [];

        $filter = \Net_LDAP2_Filter::parse($ldapFilter);
        if (\MYPEAR::isError($filter)) {
            throw new \Exception($filter);
        }

        // TODO we can optimize search if serviceName was provided or objectClass is in the filter
        foreach ($this->serviceInfoMap as $serviceInfo) {
            if ($filter->matches($serviceInfo->entries) > 0) {
                $found[] = $serviceInfo->implementation;
            }
        }
        return $found;
    }

    /**
     * @param string $name
     * @param ServiceInfo $serviceInfo
     */
    private function notifyListeners($name, $serviceInfo)
    {
        if (isset($this->listenerMap[$name])) {
            foreach ($this->listenerMap[$name] as $listener) {
                $listener($serviceInfo);
            }
        }
    }

}
