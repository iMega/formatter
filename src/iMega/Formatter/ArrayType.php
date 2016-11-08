<?php

namespace iMega\Formatter;

class ArrayType extends GenericType
{
    public static function getData($value)
    {
        if (!is_array($value)) {
            throw new \RuntimeException('It not array');
        }

        return serialize($value);
    }

    public static function getValue($value)
    {
        if (false === $res = @unserialize($value)) {
            throw new \RuntimeException('String not unserialize');
        }

        return $res;
    }
}
