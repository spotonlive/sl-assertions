<?php

namespace SpotOnLive\AssertionsTest\Facades\Helpers;

use PHPUnit_Framework_TestCase;

class AssertionHelperFacadeTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\Assertions\Facades\Helpers\AssertionHelperFacade */
    protected $facade;

    public function setUp()
    {
        $facade = new \SpotOnLive\Assertions\Facades\Helpers\AssertionHelperFacade();
        $this->facade = $facade;
    }

    public function testMethodGetFacadeAccessor()
    {
        $method = $this->getMethod('getFacadeAccessor');
        $obj = new $this->facade;
        $result = $method->invokeArgs($obj, []);

        $this->assertEquals('SpotOnLive\Assertions\Providers\Helpers\AssertionHelperProvider', $result);
    }

    /**
     * Get protected/private method from facade
     *
     * @param $name
     * @return \ReflectionMethod
     */
    protected function getMethod($name)
    {
        $class = new \ReflectionClass(get_class($this->facade));

        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}