<?php

/**
 * Assertions for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\Assertions
 */

namespace SpotOnLive\Assertions\Providers\Helpers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use SpotOnLive\Assertions\Helpers\AssertionHelper;

class AssertionsHelperProvider extends ServiceProvider
{
    /**
     * Register assertions
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider', function(Application $application) {
            /** @var \SpotOnLive\Assertions\Services\AssertionService $assertionService */
            $assertionService = $application->make('SpotOnLive\Assertions\Services\AssertionService');

            return new AssertionHelper($assertionService);
        });
    }
}
