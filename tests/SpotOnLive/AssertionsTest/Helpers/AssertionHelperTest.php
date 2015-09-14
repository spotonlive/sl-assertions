<?php

namespace SpotOnLive\AssertionsTest\Helpers;

use PHPUnit_Framework_TestCase;

class AssertionHelperTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\Assertions\Helpers\AssertionHelper */
    protected $helper;

    /** @var \SpotOnLive\Assertions\Services\AssertionServiceInterface */
    protected $assertionService;

    public function setUp()
    {
        $assertionService = $this->getMockBuilder('SpotOnLive\Assertions\Services\AssertionServiceInterface')
            ->setMethods(['isGranted'])
            ->getMock();

        $this->assertionService = $assertionService;

        $helper = new \SpotOnLive\Assertions\Helpers\AssertionHelper($assertionService);
        $this->helper = $helper;
    }

    public function testIsGranted()
    {
        $name = "assertion.name";
        $user = "user-entity";
        $data = [
            'key' => 'value'
        ];

        $this->assertionService->expects($this->at(0))
            ->method('isGranted')
            ->with($name, $user, $data)
            ->willReturn(true);

        $result = $this->helper->isGranted($name, $user, $data);

        $this->assertTrue($result);
    }
}
