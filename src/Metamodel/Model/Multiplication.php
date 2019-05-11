<?php


namespace App\Metamodel\Model;


class Multiplication extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_MULTIPLICATION;
    }
}