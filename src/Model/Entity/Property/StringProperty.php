<?php

declare(strict_types=1);

namespace TheImp\Model\Entity\Property;

/**
 * @property string $default
 */
class StringProperty extends Property
{
    public const TYPE = self::TYPE_STRING;

    protected int $min;
    protected int $max;

    public function sanitize($value): string
    {
        return (string) $value;
    }

    public function validate($value, &$message): bool
    {
        if (is_string($value)) {
            $message = 'must be a string';
            return true;
        }
        return false;
    }
}
