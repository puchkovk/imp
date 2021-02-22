<?php

declare(strict_types=1);

namespace TheImp\Model\Entity\Property;

/**
 * @property bool $default
 */
class BoolProperty extends Property
{
    public const TYPE = self::TYPE_BOOL;

    public function sanitize($value): bool
    {
        return (bool) $value;
    }

    public function validate($value, &$message): bool
    {
        if (is_bool($value)) {
            $message = 'must be bool';
            return true;
        }
        return false;
    }
}
