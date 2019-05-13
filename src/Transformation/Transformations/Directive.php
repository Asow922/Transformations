<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;

abstract class Directive
{
    abstract public static function translate(Attribute $attribute, Root $model): bool;

    protected static function getDirectiveName(Attribute $attribute)
    {
        return trim(mb_strtolower($attribute->getName()));
    }
}