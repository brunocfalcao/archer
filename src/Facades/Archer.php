<?php

namespace Brunocfalcao\Archer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Brunocfalcao\Archer\Archer
 */
class Archer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Brunocfalcao\Archer\Archer::class;
    }
}
