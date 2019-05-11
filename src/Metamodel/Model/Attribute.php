<?php


namespace App\Metamodel\Model;


use App\Metamodel\Utils\ArrayUtil;

class Attribute
{
    /** @var string */
    protected $name;

    /** @var array */
    protected $expressions;

    /**
     * Attribute constructor.
     */
    public function __construct()
    {
        $this->expressions = [];
    }


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
}