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
        } catch (\Exception $e) {
            $this->assertSame($expected, $e->getMessage());
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
                'expected' => 'Wrong field name',
            ],
            [
                'data' => [
                    IntType::setDefault('intType', 10),
                ],
                'expected' => 'Wrong field name',
            ],
            [
                'data' => [
                    [],
                ],
                'expected' => 'Wrong type',
            ],
            [
                'data' => [
                    'blah-blah-blah',
                ],
                'expected' => 'Wrong type',
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
        $actual = $formatter->getData($name, $value);

        $this->assertSame($expected, $actual);
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

        $this->assertSame($expected, $actual);
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
        ];
    }
}
