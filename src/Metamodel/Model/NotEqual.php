<?php


namespace App\Metamodel\Model;


class NotEqual extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_NOT_EQUAL;
    }
}