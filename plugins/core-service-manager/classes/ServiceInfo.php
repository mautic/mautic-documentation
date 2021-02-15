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
namespace Twelvetone\Common;

use Closure;
use Net_LDAP2_Entry;

require_once "ObjectAccess.php";

/**
 * Class ServiceInfo
 * @package Twelvetone\Common
 * @property string service
 * @property integer serviceId
 * @property mixed implementation
 * @property array properties
 * @property Net_LDAP2_Entry entries
 * // calculated
 * @property boolean isInstantiated
 */
class ServiceInfo extends ObjectAccess
{
    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    function &__get($name)
    {
        switch ($name) {
            case 'implementation':
                $val =& parent::__get($name);
                if ($val instanceof Closure) {
                    $val = $val();
                    $this->setInternal($name, $val);
                }
                return $val;
            case 'isInstantiated':
                $impl =& parent::__get('implementation');
                $ret = !($impl instanceof Closure);
                return $ret;
            default:
                $ret =& parent::__get($name);
                return $ret;
        }
    }
}