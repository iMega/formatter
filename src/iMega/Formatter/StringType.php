<?php

namespace iMega\Formatter;

class StringType extends GenericType
{
    public static function getData($value)
    {
        return (string)$value;
    }

    public static function getValue($value)
    {
        return (string)$value;
    }
}
