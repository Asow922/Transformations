<?php


namespace App\Metamodel\Model;


class Equal extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_EQUAL;
    }
}