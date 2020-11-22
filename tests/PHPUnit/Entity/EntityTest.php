<?php
namespace TheImpTests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Exception\Entity\UnknownPropertyException;
use TheImpTest\Mock\Entity\DummyEntityOne;

class EntityTest extends TestCase
{

    public function testBasicUsage(): void
    {
        $entity = new DummyEntityOne([
            'id'    => 1,
            'title' => 'One',
                                     ]);

        $this->assertEquals(1,     $entity->id);
        $this->assertEquals('One', $entity->title);
    }

    public function testGet(): void
    {
        $entity = new DummyEntityOne([
                                         'id'    => 1,
                                         'title' => 'One',
                                     ]);
        $entity->id = 2;
        $this->assertEquals(2,     $entity->id);
        $entity->id = 3;
        $this->assertEquals(3,     $entity->id);

        $entitySecondOne = new DummyEntityOne([
                                         'id'    => 1,
                                     ]);
        $title = $entitySecondOne->title;
        $this->assertNull($title);
    }

    public function testSetUnknownProperty(): void
    {
        $entity = new DummyEntityOne([
                                         'id'    => 1,
                                         'title' => 'One',
                                     ]);

        $this->expectException(UnknownPropertyException::class);

        $entity->set('foo', 43);
    }

    public function testGetUnknownProperty(): void
    {
        $entity = new DummyEntityOne([
                                         'id'    => 1,
                                         'title' => 'One',
                                     ]);

        $this->expectException(UnknownPropertyException::class);

        $foo = $entity->get('foo');
    }

    public function testToArray(): void
    {
        $entity = new DummyEntityOne([
            'id'    => 1,
            'title' => 'One',
                                     ]);

        $array = $entity->toArray();

        $this->assertEquals(1,     $array['id']);
        $this->assertEquals('One', $array['title']);
    }
}