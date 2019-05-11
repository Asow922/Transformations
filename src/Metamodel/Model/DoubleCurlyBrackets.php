<?php

namespace App\Metamodel\Model;

use App\Metamodel\Utils\ArrayUtil;

class DoubleCurlyBrackets extends OneVariableExpression
{
    const REG_EXP = '/{\{\s*(.*?)\s*\}\}/';

    /** @var array */
    protected $functions;

    /**
     * DoubleCurlyBrackets constructor.
     * @param Expression $expression
     * @param array $functions
     */
    public function __construct(Expression $expression, array $functions = [])
    {
        parent::__construct($expression);
        $this->functions = $functions;
    }

    /**
     * @return string
     */
    function getOperator(): string
    {
        return self::OPERATOR_DOUBLE_CURLY_BRACKETS;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return $this->functions;
    }

    /**
     * @param FunctionMethod $function
     */
    public function addFunction(FunctionMethod $function): void
    {
        $this->functions[] = $function;
    }

    /**
     * @param FunctionMethod $function
     */
    public function removeFunction(FunctionMethod $function): void
    {
        ArrayUtil::removeFromArray($this->functions, $function);
    }
}