<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Metamodel\Model\Text;

class DirectiveNgFor extends Directive
{
    /**
     * @param Attribute $attribute
     * @param Root $model
     * @return bool
     */
    public static function translate(Attribute $attribute, Root $model): bool
    {
        $directive = self::getDirectiveName($attribute);

        if ($directive == 'ng-repeat') {
            $attribute->setName('*ngFor');
            $expr = array_merge([new Text('let')], $attribute->getExpressions());

            foreach ($expr as $one) {
                if ($one instanceof Text) {
                    $one->setValue(str_replace(' in ', ' of ', $one->getValue()));
                }
            }

            $attribute->setExpressions($expr);

            return true;
        }
        return false;
    }
}