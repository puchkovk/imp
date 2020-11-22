<?php

declare(strict_types=1);

namespace TheImp\Model\Validator;

use TheImp\Model\Entity\EntityInterface;

interface EntityValidatorInterface extends ValidatorInterface
{
    public function validate($subject): bool;
}