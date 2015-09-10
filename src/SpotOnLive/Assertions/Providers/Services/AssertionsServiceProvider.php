<?php

/**
 * Assertions for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\Assertions
 */

namespace SpotOnLive\Assertions\Providers\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use SpotOnLive\Assertions\Exceptions\IllegalConfigurationException;

class AssertionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('assertions.php'),
        ]);
    }

    /**
     * Register assertions
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\Assertions\Services\AssertionsService', function(Application $app) {
            $assertionsConfig = config('assertion');
            $assertions = [];

            if (isset($assertionsConfig['assertions'])) {
                if (!is_array($assertionsConfig['assertions'])) {
                    throw new IllegalConfigurationException('Assertion configuration must be of type array');
                }

                $assertions = $assertionsConfig['assertions'];
            }

            return new Services\AssertionService($assertions);
        });

        $this->app->alias('SpotOnLive\Assertions\Services\AssertionsService', 'slassertions');

        $this->mergeConfig();
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'assertions'
        );
    }
}
