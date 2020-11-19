<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed run(string $namespace, string $class, ...$args)
 *
 * @see \App\Support\Executor
 */
class Executor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'executor';
    }
}
