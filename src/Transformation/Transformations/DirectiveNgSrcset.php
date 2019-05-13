<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Metamodel\Model\Text;

class DirectiveNgSrcset extends Directive
{

    public static function translate(Attribute $attribute, Root $model): bool
    {
        $directive = self::getDirectiveName($attribute);

        if ($directive == 'ng-srcset') {
            $attribute->setName('srcset');
            $firstImg = array_map('trim', explode(',',$attribute->getExpressions()[0]))[0];
            $newAttribute = new Attribute();
            $newAttribute->setName('[src]');
            $newAttribute->addExpression(new Text($firstImg));
            $model->addAttribute($newAttribute);

            return true;
        }

        return false;
    }
}