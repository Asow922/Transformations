<?php


namespace App\Metamodel\Model;


class Division extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_DIVISION;
    }
}