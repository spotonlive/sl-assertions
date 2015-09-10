<?php

namespace SpotOnLive\AssertionsTest\Providers\Helpers;

use PHPUnit_Framework_TestCase;

class AssertionHelperProviderTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider */
    protected $provider;

    /** @var \Illuminate\Foundation\Application */
    protected $app;

    public function setUp()
    {
        $app = $this->getMockBuilder('Illuminate\Foundation\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $this->app = $app;

        $provider = new \SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider($app);
        $this->provider = $provider;
    }

    public function testRegister()
    {
        $this->app->expects($this->at(0))
            ->method('bind')
            ->with('SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider');

        $this->provider->register();
    }
}