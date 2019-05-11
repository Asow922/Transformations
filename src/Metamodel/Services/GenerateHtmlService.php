<?php


namespace App\Metamodel\Services;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;

class GenerateHtmlService
{
    public function generate(Root $model)
    {
        return $this->generateHTML($model);
    }

    protected function generateHTML(Root $model, $html = '')
    {
        if ($model->getName() == '__text') {
            $txt = '';
            foreach ($model->getExpressions() as $expression) {
                $txt .= $expression;
            }
            return $txt;
        }

        $html .= '<' . $model->getName();
        $html .= ' ' . $this->generateAttr($model);
        $html = trim($html) . '>';

        foreach ($model->getLeafs() as $leaf) {
            $html .= $this->generateHTML($leaf);
        }

        return $html . '</' . $model->getName() . '>';
    }

    protected function generateAttr(Root $model)
    {
        $attr = [];

        /** @var Attribute $one */
        foreach ($model->getAttributes() as $one) {
            $attrStr = $one->getName() . '="';
            $expr = [];
            foreach ($one->getExpressions() as $expression) {
                $expr[] = $expression;
            }
            $attrStr .= implode(' ', $expr);

            $attr[] = trim($attrStr) . '"';
        }

        return trim(implode(' ', $attr));
    }
}