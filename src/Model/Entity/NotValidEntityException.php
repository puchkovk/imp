<?php

declare(strict_types=1);

namespace TheImp\Model\Entity;

use TheImp\Exception\Exception;
use Throwable;

class NotValidEntityException extends Exception
{
    /**
     * @var array<string, string>
     */
    protected array $properties;

    /**
     * NotValidEntityException constructor.
     *
     * @param string $entityName
     * @param array<string, string> $properties
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $entityName, array $properties, int $code = 0, Throwable $previous = null)
    {
        $this->properties = $properties;

        $message = 'Entity ' . $entityName  . ' not valid:';
        foreach ($properties as $property => $error) {
            $message .= ' ' . $property . ': ' . $error;
        }

        parent::__construct($message, $code, $previous);
    }
}
