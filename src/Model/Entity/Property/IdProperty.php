<?php

declare(strict_types=1);

namespace TheImp\Model\Entity\Property;

/**
 * @property int $default
 */
class IdProperty extends Property
{
    public const TYPE = self::TYPE_INT;

    public function sanitize($value): string
    {
        return (string) $value;
    }

    public function validate($value, &$message): bool
    {
        if (null !== $value && empty($value)) {
            $message = 'empty but not null';
            return false;
        }
        if (!is_string($value)) {
            $message = 'must be a string';
            return false;
        }

        return true;
    }
}
