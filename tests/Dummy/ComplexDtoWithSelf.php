<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\DataTransferObject;

class ComplexDtoWithSelf extends DataTransferObject
{
    public string $name;

    public ?self $other;
}
