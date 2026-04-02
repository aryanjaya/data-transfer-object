<?php

namespace Aryanjaya\DataTransferObject;

interface Caster
{
    public function cast(mixed $value): mixed;
}
