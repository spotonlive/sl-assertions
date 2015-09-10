<?php

/**
 * Assertions for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\Assertions
 */

namespace SpotOnLive\Assertions\Providers\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\Assertions\Exceptions\IllegalConfigurationException;
use SpotOnLive\Assertions\Services\AssertionService;

class AssertionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../../config/config.php' => config_path('assertions.php'),
        ]);
    }

    /**
     * Register assertions
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\Assertions\Services\AssertionService', function(Application $app) {
            $assertionsConfig = config('assertions');
            $assertions = [];

            if (isset($assertionsConfig['assertions'])) {
                if (!is_array($assertionsConfig['assertions'])) {
                    throw new IllegalConfigurationException('Assertion configuration must be of type array');
                }

                $assertions = $assertionsConfig['assertions'];
            }

            return new AssertionService($assertions);
        });

        $this->app->alias('SpotOnLive\Assertions\Services\AssertionService', 'AssertionService');

        $this->mergeConfig();
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../../config/config.php', 'assertions'
        );
    }
}
