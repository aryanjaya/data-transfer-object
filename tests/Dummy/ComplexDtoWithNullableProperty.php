<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\DataTransferObject;

class ComplexDtoWithNullableProperty extends DataTransferObject
{
    public string $name;

    public ?BasicDto $other;
}
