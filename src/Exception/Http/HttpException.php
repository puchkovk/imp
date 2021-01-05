<?php

declare(strict_types=1);

namespace TheImp\Exception\Http;

use TheImp\Exception\Exception as ImpException;
use Throwable;

class HttpException extends ImpException
{
    public function __construct(int $httpCode, string $message = "", Throwable $previous = null)
    {
        parent::__construct($message, $httpCode, $previous);
    }
}
