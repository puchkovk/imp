<?php

declare(strict_types=1);

namespace TheImp\Model\Entity\Property;

/**
 * @property float $default
 */
class FloatProperty extends Property
{
    public const TYPE = self::TYPE_FLOAT;

    public function sanitize($value): float
    {
        return (float) $value;
    }

    public function validate($value, &$message): bool
    {
        if (is_float($value)) {
            $message = 'must be float';
            return true;
        }
        return false;
    }
}
