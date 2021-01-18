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
$path = "../../../system/src" . PATH_SEPARATOR . "classes";
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

if (false) {
    $path = "/Users/steven/Sites/grav/vendor/rockettheme/toolbox/ArrayTraits/src/";
    set_include_path(get_include_path() . PATH_SEPARATOR . $path);

    require_once "Export.php";
    require_once "Countable.php";
    require_once "ArrayAccess.php";
    require_once "ExportInterface.php";
    require_once "NestedArrayAccess.php";
    require_once "ArrayAccessWithGetters.php";
    require_once "NestedArrayAccessWithGetters.php";
    require_once "Grav/Common/Data/DataInterface.php";
    require_once "Grav/Common/Data/Data.php";
}

require_once 'ServiceManager.php';
