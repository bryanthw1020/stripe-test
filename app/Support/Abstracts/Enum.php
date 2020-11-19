<?php

namespace App\Support\Abstracts;

use BenSampo\Enum\Enum as BaseEnum;
use Illuminate\Support\Collection;

abstract class Enum extends BaseEnum
{
    public static function getCollection()
    {
        return Collection::make(self::getInstances())->values();
    }
}
