<?php

declare(strict_types=1);

namespace TheImp\Exception\Http;

use Exception as PhpException;
use Throwable;

class NotFoundException extends PhpException
{
    /**
     * @var int
     */
    protected $code = 404;

    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
