<?php

namespace iMega\Formatter;

class IntType extends GenericType
{
    public static function getData($value)
    {
        return (int)$value;
    }

    public static function getValue($value)
    {
        return (int)$value;
    }
}
