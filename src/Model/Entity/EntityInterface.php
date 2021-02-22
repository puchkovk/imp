<?php

declare(strict_types=1);

namespace TheImp\Model\Entity;

interface EntityInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data = []);

    public function validate(): bool;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /**
     * @param string $propertyName
     * @param mixed $value
     *
     * @return $this
     */
    public function set(string $propertyName, $value): self;

    /**
     * @param string     $propertyName
     *
     * @return mixed
     */
    public function get(string $propertyName);
}
