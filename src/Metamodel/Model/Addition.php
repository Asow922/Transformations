<?php


namespace App\Metamodel\Model;


class Addition extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_ADDITION;
    }
}