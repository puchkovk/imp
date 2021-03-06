<?php

declare(strict_types=1);

namespace TheImp\Exception\Http;

use Exception as PhpException;
use Throwable;

class MovedPermanentlyException extends PhpException
{
    /**
     * @var int
     */
    protected $code = 301;
    protected string $url;

    /**
     * @param string $url
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(string $url, $message = "", Throwable $previous = null)
    {
        $this->url = $url;
        parent::__construct($message, 301, $previous);
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
