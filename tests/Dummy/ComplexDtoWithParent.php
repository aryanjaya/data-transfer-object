<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

class ComplexDtoWithParent extends ComplexDtoWithSelf
{
    public string $name;

    public ?parent $other;
}
