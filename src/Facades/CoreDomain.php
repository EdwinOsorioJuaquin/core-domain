<?php

namespace IncadevUns\CoreDomain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IncadevUns\CoreDomain\CoreDomain
 */
class CoreDomain extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \IncadevUns\CoreDomain\CoreDomain::class;
    }
}
