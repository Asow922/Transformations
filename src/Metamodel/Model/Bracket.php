<?php


namespace App\Metamodel\Model;


class Bracket extends OneVariableExpression
{
    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_BRACKET;
    }
}