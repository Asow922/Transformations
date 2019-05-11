<?php


namespace App\Metamodel\Model;


class Text extends Expression
{
    /** @var string */
    protected $value;

    /**
     * Text constructor.
     * @param string $value
     */
    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}