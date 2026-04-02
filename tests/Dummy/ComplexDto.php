<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\DataTransferObject;

class ComplexDto extends DataTransferObject
{
    public string $name;

    public BasicDto $other;
}
