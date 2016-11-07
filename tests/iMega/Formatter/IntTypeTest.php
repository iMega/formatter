<?php

namespace iMega\Formatter;

class IntTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $actual = IntType::getData(10);
        $this->assertSame(10, $actual);
    }

    public function testGetValue()
    {
        $actual = IntType::getValue(10);
        $this->assertSame(10, $actual);
    }
}
