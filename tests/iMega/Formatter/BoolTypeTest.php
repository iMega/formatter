<?php

namespace iMega\Formatter;

class BoolTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $actual = BoolType::getData(true);
        $this->assertSame(1, $actual);

        $actual = BoolType::getData(false);
        $this->assertSame(0, $actual);
    }

    public function testGetValue()
    {
        $actual = BoolType::getValue(true);
        $this->assertSame(true, $actual);

        $actual = BoolType::getValue(false);
        $this->assertSame(false, $actual);
    }
}
