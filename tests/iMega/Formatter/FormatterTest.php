<?php

namespace iMega\Formatter;

class FormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $data
     * @param mixed $expected
     * @dataProvider instanceDataProvider
     */
    public function testInstance(array $data, $expected)
    {
        try {
            $actual = new Formatter($data);
            $this->assertInstanceOf($expected, $actual);
        } catch (FormatterException $e) {
            $this->assertEquals($expected, $e);
        }
    }

    /**
     * @see testInstance
     * @return array
     */
    public function instanceDataProvider()
    {
        return [
            [
                'data' => [
                    IntType::setDefault('int_type', 10),
                ],
                'expected' => '\\iMega\\Formatter\\Formatter',
            ],
            [
                'data' => [
                    IntType::setDefault('int-type', 10),
                ],
                'expected' => new FormatterException('Wrong field name'),
            ],
            [
                'data' => [
                    IntType::setDefault('intType', 10),
                ],
                'expected' => new FormatterException('Wrong field name'),
            ],
            [
                'data' => [
                    [],
                ],
                'expected' => new FormatterException('Wrong type'),
            ],
            [
                'data' => [
                    'blah-blah-blah',
                ],
                'expected' => new FormatterException('Wrong type'),
            ],
            [
                'data' => [
                    ['name', 'defaultValue', '\\Exception', 0],
                ],
                'expected' => new FormatterException('Wrong instance'),
            ],
        ];
    }

    /**
     * @param array  $data
     * @param string $name
     * @param mixed  $value
     * @param mixed  $expected
     * @dataProvider getDataDataProvider
     */
    public function testGetData(array $data, $name, $value, $expected)
    {
        $formatter = new Formatter($data);
        try {
            $actual = $formatter->getData($name, $value);
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
                    IntType::setDefault('my_int', 100500),
                ],
                'name' => 'my_int',
                'value' => 10,
                'expected' => 10,
            ],
            [
                'data' => [
                    IntType::setDefault('my_int', 100500),
                ],
                'name' => 'my_int',
                'value' => 'blah-blah-blah',
                'expected' => 0,
            ],
            [
                'data' => [
                    JsonType::setDefault('my_json', []),
                ],
                'name' => 'my_json',
                'value' => [
                    'foo' => 'bar',
                ],
                'expected' => '{"foo":"bar"}',
            ],
            [
                'data' => [
                    DateTimeType::setDefault('my_date', date_create_from_format('Y-m-d H:i:s', '2016-11-08 10:25:00'))
                ],
                'name' => 'my_date',
                'value' => 'WRONG DATE',
                'expected' => '2016-11-08 10:25:00',
            ],
            [
                'data' => [
                    JsonType::setDefault('my_json', []),
                ],
                'name' => 'my_json_other',
                'value' => [
                    'foo' => 'bar',
                ],
                'expected' => new FormatterException('Field not exists'),
            ],
        ];
    }

    /**
     * @param array  $data
     * @param string $name
     * @param mixed  $value
     * @param mixed $expected
     * @dataProvider getValueDataProvider
     */
    public function testGetValue(array $data, $name, $value, $expected)
    {
        $formatter = new Formatter($data);
        $actual = $formatter->getValue($name, $value);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @see testGetValue
     * @return array
     */
    public function getValueDataProvider()
    {
        return [
            [
                'data' => [
                    IntType::setDefault('my_int', 100500),
                ],
                'name' => 'my_int',
                'value' => 10,
                'expected' => 10,
            ],
            [
                'data' => [
                    IntType::setDefault('my_int', 100500),
                ],
                'name' => 'my_int',
                'value' => 'blah-blah-blah',
                'expected' => 0,
            ],
            [
                'data' => [
                    JsonType::setDefault('my_json', []),
                ],
                'name' => 'my_json',
                'value' => '{"foo":"bar"}',
                'expected' => [
                    'foo' => 'bar',
                ],
            ],
            [
                'data' => [
                    DateTimeType::setDefault('my_date', date_create_from_format('Y-m-d H:i:s', '2016-11-08 10:25:00'))
                ],
                'name' => 'my_date',
                'value' => 'WRONG DateTime',
                'expected' => date_create_from_format('Y-m-d H:i:s', '2016-11-08 10:25:00'),
            ],
        ];
    }

    /**
     * @param $data
     * @param $values
     * @param $expected
     * @dataProvider getDataCollectionDataProvider
     */
    public function testGetDataCollection($data, $values, $expected)
    {
        $formatter = new Formatter($data);
        $actual = $formatter->getDataCollection($values);
        $this->assertSame($expected, $actual);
    }

    /**
     * @see testGetDataCollection
     * @return array
     */
    public function getDataCollectionDataProvider()
    {
        return [
            [
                'data' => [
                    IntType::setDefault('my_int', 1),
                    JsonType::setDefault('my_json', []),
                    BoolType::setDefault('my_bool', false),
                ],
                'values' => [
                    'my_int' => 10,
                    'my_json' => [
                        'foo' => 'bar',
                    ],
                ],
                'expected' => [
                    'my_int' => 10,
                    'my_json' => '{"foo":"bar"}',
                    'my_bool' => 0,
                ],
            ],
        ];
    }

    /**
     * @param $data
     * @param $values
     * @param $expected
     * @dataProvider getValueCollectionDataProvider
     */
    public function testGetValueCollection($data, $values, $expected)
    {
        $formatter = new Formatter($data);
        $actual = $formatter->getValueCollection($values);
        $this->assertSame($expected, $actual);
    }

    /**
     * @see testGetValueCollection
     * @return array
     */
    public function getValueCollectionDataProvider()
    {
        return [
            [
                'data' => [
                    IntType::setDefault('my_int', 1),
                    JsonType::setDefault('my_json', []),
                    BoolType::setDefault('my_bool', false),
                ],
                'values' => [
                    'my_int' => 10,
                    'my_json' => '{"foo":"bar"}',
                ],
                'expected' => [
                    'my_int' => 10,
                    'my_json' => [
                        'foo' => 'bar',
                    ],
                    'my_bool' => false,
                ],
            ],
        ];
    }
}
