<?php

declare(strict_types=1);

namespace TheImp\Model\Entity\Property;

/**
 * @property int $default
 */
class IntProperty extends Property
{
    public const TYPE = self::TYPE_INT;

    public function sanitize($value): int
    {
        return (int) $value;
    }

    public function validate($value, &$message): bool
    {
        if (is_int($value)) {
            $message = 'must be an integer';
            return true;
        }
        return false;
    }
}
