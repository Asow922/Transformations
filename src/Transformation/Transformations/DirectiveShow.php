<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Metamodel\Model\Text;

class DirectiveShow extends Directive
{
    /**
     * @param Attribute $attribute
     * @param Root $model
     * @return bool
     */
    public static function translate(Attribute $attribute, Root $model): bool
    {
        $directive = self::getDirectiveName($attribute);

        if ($directive == 'ng-show') {
            $attribute->setName('[hidden]');
            $attribute->setExpressions(array_merge([new Text('!(')], $attribute->getExpressions(), [new Text(')')]));

            return true;
        }
        return false;
    }
}