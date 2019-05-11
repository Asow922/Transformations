<?php


namespace App\Metamodel\Model;


class Negation extends OneVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_NEGATION;
    }
}