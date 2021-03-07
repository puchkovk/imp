<?php

declare(strict_types=1);

namespace TheImp\Exception\Http;

use Exception as PhpException;
use Throwable;

/** 302 Found (Previously "Moved temporarily") */
class SeeOtherException extends PhpException
{
    /**
     * @var int
     */
    protected $code = 303;
    protected string $url;

    /**
     * @param string $url
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(string $url, $message = "", Throwable $previous = null)
    {
        $this->url = $url;
        parent::__construct($message, $this->code, $previous);
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
