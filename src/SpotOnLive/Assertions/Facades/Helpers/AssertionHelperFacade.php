<?php

namespace SpotOnLive\Assertions\Facades\Helper;

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
        return 'SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider';
    }
}
