<?php


namespace App\Metamodel\Model;


use App\Metamodel\Utils\ArrayUtil;

class Root
{
    /** @var array */
    protected $leafs;

    /** @var string */
    protected $name;

    /** @var array */
    protected $attributes;

    /** @var array */
    protected $expressions;

    /**
     * Root constructor.
     */
    public function __construct()
    {
        $this->attributes = [];
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
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param Attribute $attribute
     */
    public function addAttribute(Attribute $attribute): void
    {
        $this->attributes[] = $attribute;
    }

    /**
     * @param Attribute $attribute
     */
    public function removeAttribute(Attribute $attribute): void
    {
        ArrayUtil::removeFromArray($this->attributes, $attribute);
    }

    /**
     * @return array
     */
    public function getLeafs(): array
    {
        return $this->leafs;
    }

    /**
     * @param Root $leaf
     */
    public function addLeaf(Root $leaf): void
    {
        $this->leafs[] = $leaf;
    }

    /**
     * @param Root $leaf
     */
    public function removeLeaf(Root $leaf): void
    {
        ArrayUtil::removeFromArray($this->leafs, $leaf);
    }
}