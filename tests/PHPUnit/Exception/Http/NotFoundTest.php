<?php
namespace TheImp\Tests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Exception\Entity\UnknownPropertyException;
use TheImp\Exception\Http\MovedPermanentlyException;
use TheImp\Exception\Http\NotFoundException;
use TheImp\Model\Entity\Entity;
use TheImp\Model\Entity\Property\Property;
use TheImp\Test\Mock\Entity\{
    DummyEntityOne,
    DummyEntityTwo
};

class NotFoundTest extends TestCase
{
    public function testGetUrl(): void
    {
        $exception = new NotFoundException();

        $this->assertSame(404, $exception->getCode());
    }
}
