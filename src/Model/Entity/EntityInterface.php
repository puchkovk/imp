<?php

declare(strict_types=1);

namespace TheImp\Model\Entity;

interface EntityInterface
{
    /**
     * @param mixed[] $data
     *
     * @return static
     */
    public static function fromArray(array $data): self;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data);

    public function validate(): bool;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /**
     * @param string $property
     * @param mixed $value
     *
     * @return $this
     */
    public function set(string $property, $value): self;

    /**
     * @param string     $property
     * @return $this
     */
    public function get(string $property): self;
}
