<?php
namespace TheImp\Tests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Exception\Entity\UnknownPropertyException;
use TheImp\Exception\Http\MovedPermanentlyException;
use TheImp\Model\Entity\Entity;
use TheImp\Model\Entity\Property\Property;
use TheImp\Test\Mock\Entity\{
    DummyEntityOne,
    DummyEntityTwo
};

class MovedPermanentlyTest extends TestCase
{
    public function testGetUrl(): void
    {
        $url = 'https://test.loc';
        $exception = new MovedPermanentlyException($url);

        $this->assertSame(301, $exception->getCode());
        $this->assertSame($url, $exception->getUrl());
    }
}
