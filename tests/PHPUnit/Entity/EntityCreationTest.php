<?php

declare(strict_types=1);

namespace TheImp\Tests\Tests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Test\Mock\Entity\DummyEntityOne;

class EntityCreationTest extends TestCase
{

    public function testFromArrayBatch(): void
    {
        $array = [
            [
                'id'    => 1,
                'title' => 'One',
            ],
            [
                'id'    => 2,
                'title' => 'Two',
            ],
        ];
        $entities = DummyEntityOne::fromArrayBatch($array);
        $this->assertNotEmpty($entities);
        foreach ($entities as $entity) {
            /** @var DummyEntityOne $entity */
            $this->assertInstanceOf(DummyEntityOne::class, $entity);
            switch ($entity->id) {
                case 1:
                    $this->assertSame('One', $entity->title);
                    break;
                case 2:
                    $this->assertSame('Two', $entity->title);
                    break;
            }
        }

    }
}
