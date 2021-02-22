<?php

declare(strict_types=1);

namespace TheImp\Model\Entity;

use TheImp\Model\Entity\Property\Property;
use TheImp\Exception\Entity\UnknownPropertyException;

abstract class Entity implements EntityInterface
{
    /**
     * @var array<string, array<string, Property>>
     */
    private static array $properties;

    /**
     * @var array<string, mixed>
     */
    private array $propertyValues;

    /**
     * @param Property[] $properties
     */
    protected static function configureProperties(array $properties): void
    {
        foreach ($properties as $property) {
            self::$properties[static::class][$property->getName()] = $property;
        }
    }

    /**
     * @return Property[]
     */
    abstract protected static function properties(): array;

    public function validate(): bool
    {
        return true;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data = [])
    {
        if ( !isset(self::$properties[static::class])) {
            self::configureProperties(static::properties());
        }
        $clearData = [];
        $notValidProperties = [];
        foreach (self::$properties[static::class] as $propertyName => $property) {
            if (!isset($data[$propertyName]) && $property->isNullable()) {
                $clearData[$propertyName] = null;
            } elseif (isset($data[$propertyName])) {
                $value = $property->sanitize($data[$propertyName]);
                if (null === $value) {
                    $clearData[$propertyName] = null;
                } else {
                    $valid = $property->validate($value, $validationMessage);
                    if ($valid) {
                        $clearData[$propertyName] = $value;
                    } else {
                        $notValidProperties[$propertyName] = $validationMessage;
                    }
                }
            } else {
                $notValidProperties[$propertyName] = 'Property missed but not nullable';
            }
        }
        if (!empty($notValidProperties)) {
            throw new NotValidEntityException(static::class, $notValidProperties);
        }
        $this->propertyValues = $clearData;
    }

    public function toArray(): array
    {
        return $this->propertyValues;
    }

    /**
     * @param array<array<mixed>> $array
     * @return self[]
     */
    public static function fromArrayBatch(array $array): array
    {
        $result = [];
        foreach ($array as $row) {
            $result[] = new static($row);
        }

        return $result;
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     *
     * @return $this
     *
     * @throws UnknownPropertyException
     */
    public function set(string $propertyName, $value): self
    {
        if (self::isPropertyExist($propertyName)) {
            $this->propertyValues[$propertyName] = $value;
        } else {
            throw new UnknownPropertyException(
                'Trying to access unknown property ' . $propertyName . ' of ' . static::class
            );
        }

        return $this;
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     *
     * @return void
     *
     * @throws UnknownPropertyException
     */
    public function __set(string $propertyName, $value): void
    {
        $this->set($propertyName, $value);
    }

    /**
     * @param string $propertyName
     *
     * @return mixed
     *
     * @throws UnknownPropertyException
     */
    public function get(string $propertyName)
    {
        if (isset($this->propertyValues[$propertyName])) {
            return $this->propertyValues[$propertyName];
        } elseif ( !self::isPropertyExist($propertyName)) {
            throw new UnknownPropertyException(
                'Trying to access unknown property ' . $propertyName . ' of ' . static::class
            );
        }

        return null;
    }

    /**
     * @param string $propertyName
     *
     * @return mixed
     *
     * @throws UnknownPropertyException
     */
    public function __get(string $propertyName)
    {
        return $this->get($propertyName);
    }

    protected final static function isPropertyExist(string $propertyName): bool
    {
        return isset(self::$properties[static::class][$propertyName]);
    }
}
