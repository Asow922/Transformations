<?php


namespace App\Metamodel\Model;


use App\Metamodel\Utils\ArrayUtil;

class FunctionMethod
{
    /** @var string */
    protected $name;

    /** @var array */
    protected $expressions;

    /** @var array */
    protected $functions;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getExpressions(): array
    {
        return $this->expressions;
    }

    /**
     * @param Expression $expression
     */
    public function addExpression(Expression $expression): void
    {
        $this->expressions[] = $expression;
    }

    /**
     * @param Expression $expression
     */
    public function removeExpression(Expression $expression): void
    {
        ArrayUtil::removeFromArray($this->expressions, $expression);
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