<?php

namespace iMega\Formatter;

class FloatType extends GenericType
{
    public static function getData($value)
    {
        return floatval($value);
    }

    public static function getValue($value)
    {
        return floatval($value);
    }
}
