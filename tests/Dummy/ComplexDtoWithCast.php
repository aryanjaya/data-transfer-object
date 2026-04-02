<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\Attributes\DefaultCast;
use Aryanjaya\DataTransferObject\DataTransferObject;

#[DefaultCast(ComplexObject::class, ComplexObjectCaster::class)]
class ComplexDtoWithCast extends DataTransferObject
{
    public string $name;

    public ComplexObject $object;
}
