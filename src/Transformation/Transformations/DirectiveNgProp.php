<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;

class DirectiveNgProp extends Directive
{
    public static function translate(Attribute $attribute, Root $model): bool
    {
        $directive = self::getDirectiveName($attribute);

        if (strpos($directive, 'ng-prop-') !== false) {
            $newDirective = str_replace('ng-prop-', '', $directive);
            $newDirective = explode('_', $newDirective);
            $tmp = $newDirective;
            unset($tmp[0]);
            $newDirective = $newDirective[0] . implode('', array_map('ucfirst', $tmp));
            $attribute->setName('['.$newDirective.']');
            return true;
        }

        return false;
    }
}