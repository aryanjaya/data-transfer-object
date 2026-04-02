<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\Attributes\CastWith;

#[CastWith(ComplexObjectWithCasterCaster::class)]
class ComplexObjectWithCaster
{
    public function __construct(
        public string $name,
    ) {
    }
}
