<?php

namespace Laveto\LaravelMultivers\Facades;

use Illuminate\Support\Facades\Facade;

class Multivers extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'multivers';
    }
}
