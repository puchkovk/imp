<?php

declare(strict_types=1);

namespace TheImp\Model\Validator;

use TheImp\Exception\ValidationException;

interface ValidatorInterface
{
    /**
     * @param mixed $subject
     *
     * @return bool
     *
     * @throws ValidationException
     */
    public function validate($subject): bool;
}