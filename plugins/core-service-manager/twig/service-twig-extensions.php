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

use Twelvetone\Common\ServiceManager;

class ServiceTwigExtensions extends \Twig_Extension
{
    private static function quoteEscape($string)
    {
        return str_replace("\"", "\\\"", $string);
    }

    private static function encode($item)
    {
        return json_encode($item);
    }

    private static function stringify($value)
    {
        return self::quoteEscape(self::encode($value));
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('service_render', [$this, 'service_render', 0]),
            new \Twig_SimpleFunction('service_render_count', [$this, 'service_render_count', 0]),
            new \Twig_SimpleFunction('service_items', [$this, 'service_items', 0]),
            new \Twig_SimpleFunction('service_list', [$this, 'service_list', 0]),
            new \Twig_SimpleFunction('service_list_filter', [$this, 'service_list_filter', 0]),
        ];
    }

    /**
     *
     * Returns the number of services that will render
     *
     * @param string $serviceName The service name.
     * @param string $scope The scope to filter.  null or 'any' to match all scopes.
     * @param string $order The order.  null or 'any' to match all items.
     * @param null $context
     * @return number
     */
    public function service_render_count($serviceName, $scope = null, $order = null, $context = null)
    {
        $ret = 0;
        if ($scope) {
            $scope = (array)$scope;
        }

        try {
            $services = ServiceManager::getInstance()->findServices(null, "(&(objectClass=$serviceName)(!(menu=*)))");
        } catch (\Exception $e) {
            // Should only happen if filter is invalid
            return 0;
        }
        foreach ($services as $service) {
            if (isset($service['isEnabled'])) {
                if (!$service['isEnabled']($context)) {
                    continue;
                }
            }
            if (isset($service['isVisible'])) {
                if (!$service['isVisible']($context)) {
                    continue;
                }
            }
            if (!$scope || !empty(array_intersect($scope, $service['scope']))) {
                if ($order == null || $order == 'any' || $order === $service['order']) {
                    $ret++;
                }
            }
        }
        return $ret;
    }

    /**
     *
     * Renders "renderer" and "action" services
     *
     * @param string $serviceName The service name.
     * @param string $scope The scope to filter.  null or 'any' to match all scopes.
     * @param string $order The order.  null or 'any' to match all items.
     * @param null $context
     * @return string
     */
    public function service_render($serviceName, $scope = null, $order = null, $context = null)
    {
        if ($scope) {
            $scope = (array)$scope;
        }

        try {
            $services = ServiceManager::getInstance()->findServices(null, "(&(objectClass=$serviceName)(!(menu=*)))");
        } catch (\Exception $e) {
            // Should only happen if filter is invalid
            return '';
        }
        $out = '';
        foreach ($services as $service) {
            if (isset($service['isEnabled'])) {
                if (!$service['isEnabled']($context)) {
                    continue;
                }
            }
            if (isset($service['isVisible'])) {
                if (!$service['isVisible']($context)) {
                    continue;
                }
            }
            if (!$scope || !empty(array_intersect($scope, $service['scope']))) {
                if ($order == null || $order == 'any' || $order === $service['order']) {
                    if (isset($service['render'])) {
                        $out .= $service['render']($context);
                    } else if ($serviceName === 'action') {
                        $caption = $service['caption'];
                        $icon = $service['icon'];
                        $handler = "";
                        if (isset($service['clientCallback'])) {
                            $handler .= $service['clientCallback'];
                            $handler .= ";";
                        }
                        if (isset($service['serverCallbackContext'])) {
                            $serverCallbackContext = $service['serverCallbackContext'];

                        } else {
                            $serverCallbackContext = "";
                        }

                        $confirmationMessage = "";
                        if (isset($service['confirmationMessage'])) {
                            $confirmationMessage = str_replace("'", "\\'", $service['confirmationMessage']);
                        }

                        if (isset($service['serverAsyncCallback'])) {
                            $serverCallbackId = $service['serverCallbackId'];
                            $strContext = self::stringify($serverCallbackContext);
                            $handler .= "_ajaxAction(\"$serverCallbackId\", \"$strContext\", \"$confirmationMessage\");";
                        }
                        if (isset($service['serverCallback'])) {
                            $serverCallbackId = $service['serverCallbackId'];
                            $strContext = self::stringify($serverCallbackContext);
                            $handler .= "_nonAjaxAction(\"$serverCallbackId\", \"$strContext\", \"$confirmationMessage\");";
                        }
                        $handler .= "return false;";

                        $handler = "onclick='" . str_replace("'", "\\'", $handler) . "'";
//                        $handler = "onclick=\"" . str_replace("\"", "'", $handler) . "\"";

                        if ($scope && in_array("admin:sidebar", $scope)) {
                            // The admin sidebar CSS only hides caption if it is inside an <em> tag.
                            // The admin sidebar needs the href set.
                            $class = '';
                            if (isset($service['isSelected'])) {
                                if ($service['isSelected']($context)) {
                                    $class = 'selected';
                                }
                            }
                            $out .= "<li class='$class'><a href='#' $handler><i class='fa fa-fw $icon'></i><em>$caption</em></i></a></li>";
                        } else if ($scope && in_array("page:more", $scope)) {
                            // This is the format for the Admin titlebar button
                            $out .= "<li><a class='button' $handler><i class='fa $icon'></i>$caption</a></li>";
                        } else {
                            // This is the format for the Admin titlebar button
                            $out .= "<a class='button' $handler><i class='fa $icon'></i>$caption</a>";
                        }
                    }
                    $out .= ' ';
                }
            }
        }

        return $out;
    }

    /**
     * @param string $serviceName The service name
     * @param string $scope The scope to filter.  null or 'any' to match all scopes.
     * @param string $order The order.  null or 'any' to match all items.
     * @return array Concatenated list of calling 'items' on each service.
     */
    function service_items($serviceName, $scope = 'any', $order = 'any')
    {
        $services = ServiceManager::getInstance()->getServices($serviceName);
        $ret = [];
        foreach ($services as $service) {
            switch ($order) {
                case 'any':
                    $ret = array_merge($ret, $service['items']);
                    break;
                default:
                    if ($service['order'] === $order) {
                        $ret = array_merge($ret, $service['items']);
                    }
                    break;
            }
        }
        return $ret;
    }

    /**
     * @param string $serviceName The service name.
     * @param string $scope The scope to filter.  null or 'any' to match all scopes.
     * @param string $order The order.  null or 'any' to match all items.
     * @param null $context A context used when filtering the items.
     * @return array The services matching the given parameters.
     */
    function service_list($serviceName, $scope = 'any', $order = 'any', $context = null)
    {

        $scope = (array)$scope;

        $services = ServiceManager::getInstance()->getServices($serviceName);
        $ret = [];
        foreach ($services as $service) {
            if ($this->filter($service, $scope, $order, $context)) {
                $ret[] = $service;
            }
        }
        return $ret;
    }

    /**
     * @param string $ldapFilter A LDAP filter
     * @param null $context A context used when filtering the items.
     * @return array The services matching the given parameters.
     * @throws \Exception
     */
    function service_list_filter($ldapFilter, $context = null)
    {
        $ret = [];
        $manager = ServiceManager::getInstance();
        $services = $manager->findServices(null, $ldapFilter);
        foreach ($services as $service) {
            $ret[] = $service;
        }
        //TODO
        $ret = array_filter($ret, function ($a) use($context) {
            return
                ServiceManager::getInstance()->isVisible($a, $context) &&
                ServiceManager::getInstance()->isEnabled($a, $context);
        });
        return $ret;
    }

    /**
     * @param string $serviceName The service name.
     * @param string $scope The scope to filter.  null or 'any' to match all scopes.
     * @param string $order The order.  null or 'any' to match all items.
     * @param null $context A context used when filtering the items.
     * @return array The ServiceInfo objects matching the given parameters.
     */
    function service_info_list($serviceName, $scope = 'any', $order = 'any', $context = null)
    {

        $scope = (array)$scope;

        $services = ServiceManager::getInstance()->getServiceInfos($serviceName);
        $ret = [];
        foreach ($services as $service) {
            if ($this->filter($service, $scope, $order, $context)) {
                $ret[] = $service;
            }
        }
        return $ret;
    }

    private function filter(&$service, $scope, $order, $context)
    {
        if (!in_array("any", $scope)) {
            if (!isset($service['scope'])) {
                return false;
            }
            if (empty(array_intersect($scope, $service['scope']))) {
                return false;
            }
        }
        switch ($order) {
            case 'any':
                break;
            default:
                if (!isset($service['order'])) {
                    return false;
                }
                if ($service['order'] !== $order) {
                    return false;
                }
                break;
        }
        if (isset($service['isVisible'])) {
            $isVisible = $service['isVisible']($context);
            if (!$isVisible) {
                return false;
            }
        }
        if (isset($service['isEnabled'])) {
            $isEnabled = $service['isEnabled']($context);
            if (!$isEnabled) {
                return false;
            }
        }

        return true;
    }

}
