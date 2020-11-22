<?php

declare(strict_types=1);

namespace TheImpTest\Mock\Entity;

use TheImp\Model\Entity\Entity;
use TheImp\Model\Entity\Property;

/**
 * @property int    $id
 * @property string $title
 *
 */
class DummyEntityOne extends Entity
{
    protected static function properties(): array
    {
        return [
            new Property('id'),
            new Property('title'),
        ];
    }

    public function validate(): bool
    {
        return true;
    }
}
