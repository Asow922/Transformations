<?php


namespace App\Metamodel\Model;


abstract class TwoVariableExpression
{
    const OPERATOR_NOT_EQUAL = '!=';
    const OPERATOR_EQUAL = '==';
    const OPERATOR_MULTIPLICATION = '*';
    const OPERATOR_ADDITION = '+';
    const OPERATOR_SUBTRACTION = '-';
    const OPERATOR_DIVISION = '/';
    const OPERATOR_EQUAL_SIGN = '=';

    /** @var Expression */
    protected $left;

    /** @var Expression */
    protected $right;

    /**
     * TwoVirableExpression constructor.
     * @param Expression $left
     * @param Expression $right
     */
    public function __construct(Expression $left, Expression $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @return Expression
     */
    public function getLeft(): Expression
    {
        return $this->left;
    }

    /**
     * @param Expression $left
     */
    public function setLeft(Expression $left): void
    {
        $this->left = $left;
    }

    /**
     * @return Expression
     */
    public function getRight(): Expression
    {
        return $this->right;
    }

    /**
     * @param Expression $right
     */
    public function setRight(Expression $right): void
    {
        $this->right = $right;
    }

    /**
     * @return string
     */
    abstract function getOperator(): string;
}