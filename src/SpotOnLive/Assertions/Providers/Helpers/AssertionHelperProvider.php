<?php

/**
 * Assertions for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\Assertions
 */

namespace SpotOnLive\Assertions\Providers\Helpers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\Assertions\Helpers\AssertionHelper;

class AssertionHelperProvider extends ServiceProvider
{
    /**
     * Register assertions
     */
    public function register()
    {
        $this->app->bind(
            \SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider::class,
            function (Application $application) {
                /** @var \SpotOnLive\Assertions\Services\AssertionService $assertionService */
                $assertionService = $application->make('AssertionService');

                return new AssertionHelper($assertionService);
            }
        );
    }
}
