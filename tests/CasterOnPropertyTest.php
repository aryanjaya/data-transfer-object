<?php

namespace Aryanjaya\DataTransferObject\Tests;

use Aryanjaya\DataTransferObject\Attributes\CastWith;
use Aryanjaya\DataTransferObject\DataTransferObject;
use Aryanjaya\DataTransferObject\Tests\Dummy\ComplexObject;
use Aryanjaya\DataTransferObject\Tests\Dummy\ComplexObjectCaster;

class CasterOnPropertyTest extends TestCase
{
    /** @test */
    public function property_is_casted()
    {
        $dto = new class (complexObject: [ 'name' => 'test' ]) extends DataTransferObject {
            #[CastWith(ComplexObjectCaster::class)]
            public ComplexObject $complexObject;
        };

        $this->assertEquals('test', $dto->complexObject->name);
    }
}
