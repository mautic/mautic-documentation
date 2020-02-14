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

class MarkdownTools
{
    static public function replaceSection($content, $section, $newSectionName, $newSectionContent)
    {
        $rx = '~^([#]+\s*)(.*)$~m';
        preg_match($rx, $section, $m);
        $md = $m[1];

        $ret = $content;

        $level = 0;
        for ($i = 0; $i < strlen($section); $i++) {
            if ($section[$i] === '#') {
                $level++;
            } else {
                break;
            }
        }
        $end = "^[#]{1,$level}[^#]|\\Z";

        $xsection = preg_quote($section);
        $rx = "~(^$xsection)(\n?)(.*?)\n?($end)~ms";

        $xnewHeading = preg_replace("#\\$#", "\\\\$", $newSectionName);
        $xnewContent = preg_replace("#\\$#", "\\\\$", $newSectionContent);

        $ret = preg_replace($rx, "$md$xnewHeading$2$xnewContent\n$4", $ret);

        return $ret;
    }

    /**
     * @param $content
     * @param $section
     * @return mixed
     * @throws Exception
     */
    static public function getSectionContents($content, $section)
    {
        $level = 0;
        for ($i = 0; $i < strlen($section); $i++) {
            if ($section[$i] === '#') {
                $level++;
            } else {
                break;
            }
        }
        $end = "(^[#]{1,$level}[^#]|\\Z)";

        $xsection = preg_quote($section);
        $rx = "~(^$xsection)(\n|\\Z)(.*?)($end)~ms";
        if (preg_match($rx, $content, $m)) {
            $ret = $m[3];
            return $ret;
        } else {
            throw new Exception("Section not found: $section");
        }
    }

    static public function removeSection($content, $section)
    {
        $rx = '~^([#]+\s*)(.*)$~m';
        preg_match($rx, $section, $m);

        $ret = $content;

        $level = 0;
        for ($i = 0; $i < strlen($section); $i++) {
            if ($section[$i] === '#') {
                $level++;
            } else {
                break;
            }
        }
//        $end = "(?!=^[#]{1,$level}[^#]|\\Z)";
        $end = "(^[#]{1,$level}[^#]|\\Z)";

        $xsection = preg_quote($section);
        $rx = "~(^$xsection)(\n*)(.*?)($end)~ms";

        $ret = preg_replace($rx, "$4", $ret);

        return $ret;
    }

    /**
     * @param $section string The heading with the pound sign
     * @return string The name of the heading without the pound sign
     */
    public static function getSectionName($section)
    {
        $rx = '~^[#]+\s*(.*)$~m';
        if (preg_match($rx, $section, $m)) {
            return $m[1];
        } else {
            return "";
        }
    }

    /**
     * @param $section string The heading with the pound sign
     * @return string The section level (base 1)
     */
    public static function getSectionLevel($section)
    {
        $rx = '~^([#]+)\s*.*$~m';
        if (preg_match($rx, $section, $m)) {
            return $m[1];
        } else {
            return "";
        }
    }
}