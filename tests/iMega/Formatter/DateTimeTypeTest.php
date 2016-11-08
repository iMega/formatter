<?php

namespace iMega\Formatter;

class DateTimeTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $data
     * @param $expected
     * @dataProvider getDataDataProvider
     */
    public function testGetData($data, $expected)
    {
        try {
            $actual = DateTimeType::getData($data);
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
                'data' => date_create_from_format('Y-m-d H:i:s', '2016-11-08 10:25:00'),
                'expected' => '2016-11-08 10:25:00',
            ],
            [
                'data' => 'It not datetime',
                'expected' => new FormatterException('It not DateTime'),
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
            $actual = DateTimeType::getValue($data);
            $this->assertEquals($expected, $actual);
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
                'data' => '2016-11-08 10:25:00',
                'expected' => date_create_from_format('Y-m-d H:i:s', '2016-11-08 10:25:00'),
            ],
            [
                'data' => 'WRONG DateTime',
                'expected' => new FormatterException('String not convert'),
            ],
        ];
    }
}
