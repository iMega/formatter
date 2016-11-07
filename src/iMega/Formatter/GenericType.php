<?php

namespace iMega\Formatter;

interface Typer
{
    public static function getData($value);
    public static function getValue($value);
}

abstract class GenericType implements Typer
{
    private function __construct() {}

    public static function setDefault($name, $defaultValue)
    {
        $error = 1;
        if (preg_match('/^[a-z0-9_]+$/', $name)) {
            $error = 0;
        }

        return [$name, $defaultValue, get_called_class(), $error];
    }
}
