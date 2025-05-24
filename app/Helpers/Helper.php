<?php

namespace App\Helpers;

class Helper
{
    public static function toKebabCase(string $str)
    {
        return strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($str)));
    }

    public static function toLabel(string $str)
    {
        return ucwords(str_replace('-', ' ', $str));
    }
}