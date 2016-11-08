<?php

namespace iMega\Formatter;

class JsonType extends GenericType
{
    public static function getData($value)
    {
        $result = json_encode($value);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new FormatterException(json_last_error_msg());
        }

        return $result;
    }

    public static function getValue($value)
    {
        $result = json_decode($value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new FormatterException(json_last_error_msg());
        }

        return $result;
    }
}
