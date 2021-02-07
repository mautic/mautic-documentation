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
class LdapTest extends \Codeception\Test\Unit
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

    public function testLdap()
    {
        $filter = "(scope=s1)";
        $lf = Net_LDAP2_Filter::parse($filter);
        $this->assertNotNull($lf);

        $props1 = [
            "caption" => "c1",
            "scope" => ['s1'],
            "info" => 'foobar1',
        ];

        $props2 = [
            "caption" => "c2",
            "scope" => ['s2'],
            "info" => 'foobar2',
        ];

        $entry1 = Net_LDAP2_Entry::createFresh('local', $props1);
        $entry2 = Net_LDAP2_Entry::createFresh('local', $props2);

        $this->assertTrue(isFiltered($lf, $entry1));
        $this->assertFalse(isFiltered($lf, $entry2));


        $lf = Net_LDAP2_Filter::parse('(|(caption=c1)(caption=c2))');
        $this->assertTrue(isFiltered($lf, $entry1));
        $this->assertTrue(isFiltered($lf, $entry2));

        $lf = Net_LDAP2_Filter::parse('(info=foo*)');
        $this->assertTrue(isFiltered($lf, $entry1));
        $this->assertTrue(isFiltered($lf, $entry2));

        $lf = Net_LDAP2_Filter::parse('(info=*1)');
        $this->assertTrue(isFiltered($lf, $entry1));
        $this->assertFalse(isFiltered($lf, $entry2));

    }
}

function isFiltered(Net_LDAP2_Filter $filter, $entry)
{
    return $filter->matches($entry) > 0;
}