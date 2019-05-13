<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;

class DirectiveRemove extends Directive
{
    protected static $toRemove = [
        'ng-jq' => true,
        'ng-app' => true,
        'ng-ref' => true,
        'ng-cloak' => true,
        'ng-controller' => true,
        'ng-csp' => true
    ];

    /**
     * @param Attribute $attribute
     * @param Root $model
     * @return bool
     */
    public static function translate(Attribute $attribute, Root $model): bool
    {
        $directive = self::getDirectiveName($attribute);
        if (isset(self::$toRemove[$directive])) {
            $model->removeAttribute($attribute);
            return true;
        }
        return false;
    }
}