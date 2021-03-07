<?php
namespace TheImp\Tests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Exception\Http\SeeOtherException;

class SeeOtherTest extends TestCase
{
    public function testGetUrl(): void
    {
        $url = 'https://test.loc';
        $exception = new SeeOtherException($url);

        $this->assertSame(303, $exception->getCode());
        $this->assertSame($url, $exception->getUrl());
    }
}
