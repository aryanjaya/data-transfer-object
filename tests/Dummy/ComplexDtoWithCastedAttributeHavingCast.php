<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\DataTransferObject;

class ComplexDtoWithCastedAttributeHavingCast extends DataTransferObject
{
    public string $name;

    public ComplexDtoWithCast $other;
}
