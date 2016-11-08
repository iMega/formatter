<?php

namespace iMega\Formatter;

class DateTimeType extends GenericType
{
    public static function getData($value)
    {
        if (!$value instanceof \DateTime) {
            throw new \RuntimeException('It not DateTime');
        }

        return $value->format('Y-m-d H:i:s');
    }

    public static function getValue($value)
    {
        if (false === $dateTime = date_create_from_format('Y-m-d H:i:s', $value)) {
            throw new \RuntimeException('String not convert');
        }

        return $dateTime;
    }
}
