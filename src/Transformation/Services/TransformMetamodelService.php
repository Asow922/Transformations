<?php


namespace App\Transformation\Services;


use App\Metamodel\Model\Root;

class TransformMetamodelService
{
    public function transform(Root $model) {
        return $model;
    }
}