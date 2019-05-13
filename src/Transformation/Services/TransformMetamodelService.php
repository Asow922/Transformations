<?php


namespace App\Transformation\Services;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Transformation\Transformations\Directive;
use App\Transformation\Transformations\DirectiveMap;
use App\Transformation\Transformations\DirectiveNgOn;
use App\Transformation\Transformations\DirectiveNgProp;
use App\Transformation\Transformations\DirectiveNgSrcset;
use App\Transformation\Transformations\DirectiveRemove;

class TransformMetamodelService
{
    public function transform(Root $model) {
        foreach ($model->getLeafs() as $leaf) {
            $this->transform($leaf);
        }

        /** @var Attribute $attribute */
        foreach ($model->getAttributes() as $attribute) {
            $this->transformAttr($attribute, $model);
        }

        return $model;
    }

    protected function transformAttr(Attribute $attribute, Root $model) {

        $registeredTransform = [
            new DirectiveRemove(),
            new DirectiveMap(),
            new DirectiveNgProp(),
            new DirectiveNgOn(),
            new DirectiveNgSrcset()
        ];

        foreach ($registeredTransform as $transform) {
            if ($transform instanceof Directive && $transform::translate($attribute, $model)) {
                return true;
            }
        }
    }
}