<?php


namespace App\Metamodel\Model;


class EqualSign extends TwoVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_EQUAL_SIGN;
    }
}