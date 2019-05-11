<?php


namespace App\Metamodel\Model;


class ObjectExpression extends Expression
{
    /** @var Variable */
    protected $variable;

    /** @var FunctionMethod */
    protected $function;

    /**
     * @return Variable
     */
    public function getVariable(): Variable
    {
        return $this->variable;
    }

    /**
     * @param Variable $variable
     */
    public function setVariable(Variable $variable): void
    {
        $this->variable = $variable;
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