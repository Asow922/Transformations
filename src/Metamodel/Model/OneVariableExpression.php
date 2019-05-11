<?php


namespace App\Metamodel\Model;


abstract class OneVariableExpression extends Expression
{
    const OPERATOR_NEGATION = '!';
    const OPERATOR_BRACKET = '()';
    const OPERATOR_DOUBLE_CURLY_BRACKETS = '{{}}';

    /** @var Expression */
    protected $expression;

    /**
     * OneVariableExpression constructor.
     * @param Expression $expression
     */
    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return Expression
     */
    public function getExpression(): Expression
    {
        return $this->expression;
    }

    /**
     * @param Expression $expression
     */
    public function setExpression(Expression $expression): void
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    abstract function getOperator(): string ;
}