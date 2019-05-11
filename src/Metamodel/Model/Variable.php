<?php


namespace App\Metamodel\Model;


class Variable extends Expression
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $name;

    /** @var FunctionMethod */
    protected $function;

    /**
     * Variable constructor.
     * @param string $type
     * @param string $name
     */
    public function __construct(string $name, string $type = 'string')
    {
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
     * @return FunctionMethod
     */
    public function getFunction(): FunctionMethod
    {
        return $this->function;
    }

    /**
     * @param FunctionMethod $function
     */
    public function setFunction(FunctionMethod $function): void
    {
        $this->function = $function;
    }
}