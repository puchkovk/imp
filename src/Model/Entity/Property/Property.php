<?php

declare(strict_types=1);

namespace TheImp\Model\Entity\Property;

class Property
{
    public const TYPE_ID     = 'id';
    public const TYPE_INT    = 'int';
    public const TYPE_STRING = 'string';
    public const TYPE_BOOL   = 'bool';
    public const TYPE_FLOAT  = 'float';

    public const TYPE = self::TYPE_STRING;

    protected string $name;
    protected bool   $nullable = false;

    /**
     * @var mixed
     */
    protected        $default = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setNullable(bool $nullable): self
    {
        $this->nullable = $nullable;

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setDefault($value): self
    {
        $this->default = $value;

        return $this;
    }
}
