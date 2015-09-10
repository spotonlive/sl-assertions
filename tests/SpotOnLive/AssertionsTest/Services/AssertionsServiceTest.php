<?php

namespace SpotOnLive\AssertionsTest\Services;

use PHPUnit_Framework_TestCase;

class AssertionServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\Assertions\Services\AssertionService */
    protected $service;

    /** @var \Illuminate\Foundation\Application */
    protected $app;

    /** @var array */
    protected $assertions = [];

    /** @var \SpotOnLive\Assertions\AssertionInterface */
    protected $assertionClass;

    public function setUp()
    {
        $assertionClass = $this->getMockBuilder('SpotOnLive\Assertions\AssertionInterface')
            ->getMock();

        $this->assertionClass = $assertionClass;

        $assertions = [
            'a' => get_class($assertionClass),
            'b' => 'c',
        ];

        $this->assertions = $assertions;

        $app = $this->getMockBuilder('Illuminate\Foundation\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $this->app = $app;

        $service = new \SpotOnLive\Assertions\Services\AssertionService($assertions);
        $this->service = $service;
    }

    public function testMethodIsGrantedAssertionNotFound()
    {
        $name = 'assertion.name';
        $user = 'user.entity';
        $data = [
            'a' => 'b'
        ];

        $this->setExpectedException(
            'SpotOnLive\Assertions\Exceptions\AssertionNotFoundException',
            sprintf(_('The assertion \'%s\' does not exist'), $name)
        );

        $this->service->isGranted($name, $user, $data);
    }

    public function testMethodIsGrantedAssertionNotFoundClassDoesNotExist()
    {
        $name = 'b';
        $user = 'user.entity';
        $data = [
            'a' => 'b'
        ];

        $this->setExpectedException(
            'SpotOnLive\Assertions\Exceptions\AssertionNotFoundException',
            sprintf(_('The assertion class \'%s\' does not exist'), $this->assertions[$name])
        );

        $this->service->isGranted($name, $user, $data);
    }

    public function testMethodIsGrantedAssertionSuccess()
    {
        $name = 'a';
        $user = 'user.entity';
        $data = [
            'a' => 'b'
        ];

        $this->assertionClass->expects($this->any())
            ->method('assert')
            ->with($user, $data);

        $this->service->isGranted($name, $user, $data);
    }
}