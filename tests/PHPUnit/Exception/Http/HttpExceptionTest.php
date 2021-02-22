<?php
namespace TheImp\Tests\PHPUnit\Entity;

use PHPUnit\Framework\TestCase;
use TheImp\Exception\Exception as ImpException;
use TheImp\Exception\Http\HttpException;

class HttpExceptionTest extends TestCase
{
    public function testGetUrl(): void
    {
        $exception = new HttpException(418, 'I`m a teapot =)');

        $this->assertSame(418, $exception->getCode());
        $this->assertInstanceOf(ImpException::class, $exception);
    }
}
