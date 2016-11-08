<?php

namespace iMega\Formatter;

class BoolType extends GenericType
{
    public static function getData($value)
    {
        return (int)$value;
    }

    public static function getValue($value)
    {
        return (bool)$value;
    }
}
