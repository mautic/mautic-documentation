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

require_once 'classes/MarkdownTools.php';

use MarkdownTools;

class SectionReplaceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $source = "
# a
This is content a.
## aa1
## aa2
# b
## bb1
## bb2
# c
This is some content.
## cc1
## cc2
";

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $d = codecept_data_dir();
        $files = glob("$d/testfiles/*");
        foreach ($files as $file) {
        }
    }

    public function testReplaceSection()
    {
        $actual = MarkdownTools::replaceSection($this->source, "# b", "new_b", "new_content");
        $expected = "
# a
This is content a.
## aa1
## aa2
# new_b
new_content
# c
This is some content.
## cc1
## cc2
";
        $this->assertEquals($expected, $actual);
    }

    public function testReplaceFirstSection()
    {
        $actual = MarkdownTools::replaceSection($this->source, "# a", "new_a", "new_content");
        $expected = "
# new_a
new_content
# b
## bb1
## bb2
# c
This is some content.
## cc1
## cc2
";
        $this->assertEquals($expected, $actual);
    }

    public function testReplaceLastSection()
    {
        $actual = MarkdownTools::replaceSection($this->source, "# c", "c", "new_content");
        $expected = "
# a
This is content a.
## aa1
## aa2
# b
## bb1
## bb2
# c
new_content
";
        $this->assertEquals($expected, $actual);
    }

    public function testGetSection()
    {
        $actual = MarkdownTools::getSectionContents($this->source, "# a");
        $expected = "This is content a.
## aa1
## aa2\n";
        $this->assertEquals($expected, $actual);
    }

    public function testGetSection2()
    {
        $source = "
# a
## aa1
## aa2
This is content aa2.
# b
## bb1
## bb2
";
        $actual = MarkdownTools::getSectionContents($source, "## aa2");
        $expected = "This is content aa2.\n";
        $this->assertEquals($expected, $actual);
    }
}