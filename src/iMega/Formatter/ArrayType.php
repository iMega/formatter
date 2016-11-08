<?php

namespace iMega\Formatter;

class ArrayType extends GenericType
{
    public static function getData($value)
    {
        if (!is_array($value)) {
            throw new FormatterException('It not array');
        }

        return serialize($value);
    }

    public static function getValue($value)
    {
        if (false === $res = @unserialize($value)) {
            throw new FormatterException('String not unserialize');
        }

        return $res;
    }
}
