<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\Attributes\Strict;
use Aryanjaya\DataTransferObject\DataTransferObject;

#[Strict]
class ComplexStrictDto extends DataTransferObject
{
    public string $name;

    public BasicDto $other;
}
