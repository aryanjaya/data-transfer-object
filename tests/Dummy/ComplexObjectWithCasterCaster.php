<?php

namespace Aryanjaya\DataTransferObject\Tests\Dummy;

use Aryanjaya\DataTransferObject\Caster;

class ComplexObjectWithCasterCaster implements Caster
{
    /**
     * @param array|mixed $value
     *
     * @return mixed
     */
    public function cast(mixed $value): ComplexObjectWithCaster
    {
        return new ComplexObjectWithCaster(
            name: $value['name']
        );
    }
}
