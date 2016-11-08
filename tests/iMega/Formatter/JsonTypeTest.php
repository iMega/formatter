<?php

namespace iMega\Formatter;

class JsonTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $value
     * @param $expected
     * @dataProvider getDataDataProvider
     */
    public function testGetData($value, $expected)
    {
        try {
            $actual = JsonType::getData($value);
            $this->assertSame($expected, $actual);
        } catch (FormatterException $e) {
            $this->assertEquals($expected, $e);
        }
    }

    /**
     * @see testGetData
     * @return array
     */
    public function getDataDataProvider()
    {
        return [
            [
                'value' => [
                    'foo' => 'bar',
                ],
                'expected' => '{"foo":"bar"}',
            ],
            [
                'value' => "\xB1\x31",
                'expected' => new FormatterException('Malformed UTF-8 characters, possibly incorrectly encoded'),
            ],
        ];
    }

    /**
     * @param $value
     * @param $expected
     * @dataProvider getValueDataProvider
     */
    public function testGetValue($value, $expected)
    {
        try {
            $actual = JsonType::getValue($value);
            $this->assertSame($expected, $actual);
        } catch (FormatterException $e) {
            $this->assertEquals($expected, $e);
        }
    }

    /**
     * @see testGetValue
     * @return array
     */
    public function getValueDataProvider()
    {
        return [
            [
                'value' => '{"foo":"bar"}',
                'expected' => [
                    'foo' => 'bar',
                ],
            ],
            [
                'value' => '{"foo":bar"}',
                'expected' => new FormatterException('Syntax error'),
            ],
        ];
    }
}
