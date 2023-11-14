<?php
namespace App\Helpers;

class Global_Helper {
    public static function str_ucfirst(string $string)
    {
        $array_text = explode(' ',$string);
        $maping = array_map('ucfirst', array_map('strtolower', $array_text));
        return implode(' ',$maping);
    }
}
