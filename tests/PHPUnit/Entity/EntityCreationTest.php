<?php
namespace TheImp\Tests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Exception\Entity\UnknownPropertyException;
use TheImp\Model\Entity\Entity;
use TheImp\Model\Entity\Property\Property;
use TheImp\Test\Mock\Entity\{
    DummyEntityOne,
    DummyEntityTwo
};

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
