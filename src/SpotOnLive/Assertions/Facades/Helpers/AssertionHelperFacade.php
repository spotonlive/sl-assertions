<?php

namespace SpotOnLive\Assertions\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class AssertionHelperFacade extends Facade
{
    /**
     * Name of the binding container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider::class;
    }
}
