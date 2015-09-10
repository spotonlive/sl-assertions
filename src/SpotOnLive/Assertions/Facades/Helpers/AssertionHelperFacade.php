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
        $helper = new SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider;
        return 'SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider';
    }
}
