<?php

namespace Aryanjaya\DataTransferObject\Exceptions;

use Aryanjaya\DataTransferObject\Caster;
use Exception;

class InvalidCasterClass extends Exception
{
    public function __construct(string $className)
    {
        $expected = Caster::class;

        parent::__construct(
            "Class `{$className}` doesn't implement {$expected} and can't be used as a caster"
        );
    }
}
