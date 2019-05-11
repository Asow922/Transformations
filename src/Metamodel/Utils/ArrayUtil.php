<?php


namespace App\Metamodel\Utils;


class ArrayUtil
{
    public static function removeFromArray(&$array, $element) {
        if (($key = array_search($element, $array, true)) !== FALSE) {
            unset($array[$key]);
            reset($array);
        }
    }
}