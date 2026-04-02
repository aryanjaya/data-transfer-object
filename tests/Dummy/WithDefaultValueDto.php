<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\DataTransferObject;

class WithDefaultValueDto extends DataTransferObject
{
    public string $name = 'John';
}
