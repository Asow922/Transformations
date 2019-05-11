<?php


namespace App\Metamodel\Model;


class Subtraction extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_SUBTRACTION;
    }
}