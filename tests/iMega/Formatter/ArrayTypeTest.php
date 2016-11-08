<?php

namespace iMega\Formatter;

class ArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $data
     * @param $expected
     * @dataProvider getDataDataProvider
     */
    public function testGetData($data, $expected)
    {
        try {
            $actual = ArrayType::getData($data);
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
                'data' => [
                    'foo' => 'bar',
                ],
                'expected' => 'a:1:{s:3:"foo";s:3:"bar";}',
            ],
            [
                'data' => 'It not array',
                'expected' => new FormatterException('It not array'),
            ],
        ];
    }

    /**
     * @param $data
     * @param $expected
     * @dataProvider getValueDataProvider
     */
    public function testGetValue($data, $expected)
    {
        try {
            $actual = ArrayType::getValue($data);
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
                'data' => 'a:1:{s:3:"foo";s:3:"bar";}',
                'expected' => [
                    'foo' => 'bar',
                ],
            ],
            [
                'data' => 'a:1:{s:3:"foo";s:3:".....WRONG....',
                'expected' => new FormatterException('String not unserialize'),
            ],
        ];
    }
}
