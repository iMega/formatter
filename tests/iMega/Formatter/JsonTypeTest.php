<?php

namespace iMega\Formatter;

class JsonTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $actual = JsonType::getData(
            [
                'foo' => 'bar',
            ]
        );
        $this->assertSame('{"foo":"bar"}', $actual);
    }

    public function testGetValue()
    {
        $actual = JsonType::getValue('{"foo":"bar"}');
        $this->assertSame(
            [
            'foo' => 'bar',
            ],
            $actual
        );
    }
}
