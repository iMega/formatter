<?php

namespace iMega\Formatter;

class FloatTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $actual = FloatType::getData(20.99);
        $this->assertSame(20.99, $actual);

        $actual = FloatType::getData(100);
        $this->assertSame(100.0, $actual);
    }

    public function testGetValue()
    {
        $actual = FloatType::getValue(20.99);
        $this->assertSame(20.99, $actual);

        $actual = FloatType::getValue(100);
        $this->assertSame(100.0, $actual);
    }
}
