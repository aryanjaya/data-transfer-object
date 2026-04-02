<?php

namespace Aryanjaya\DataTransferObject;

use Aryanjaya\DataTransferObject\Validation\ValidationResult;

interface Validator
{
    public function validate(mixed $value): ValidationResult;
}
