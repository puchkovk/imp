<?php

declare(strict_types=1);

namespace TheImp\Test\Mock\Entity;

use TheImp\Model\Entity\Entity;
use TheImp\Model\Entity\Property\IdProperty;
use TheImp\Model\Entity\Property\StringProperty;

/**
 * @property int    $id
 * @property string $title
 *
 */
class DummyEntityTwo extends Entity
{
    protected static function properties(): array
    {
        return [
            new IdProperty('id'),
            (new StringProperty('title'))->setNullable(true),
        ];
    }

    public function validate(): bool
    {
        return true;
    }
}
