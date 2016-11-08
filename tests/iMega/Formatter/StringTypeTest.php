<?php

namespace iMega\Formatter;

class StringTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $actual = StringType::getData('blah-blah-blah');
        $this->assertSame('blah-blah-blah', $actual);

        $actual = StringType::getData(100);
        $this->assertSame('100', $actual);
    }

    public function testGetValue()
    {
        $actual = StringType::getValue('blah-blah-blah');
        $this->assertSame('blah-blah-blah', $actual);

        $actual = StringType::getValue(100);
        $this->assertSame('100', $actual);
    }
}
