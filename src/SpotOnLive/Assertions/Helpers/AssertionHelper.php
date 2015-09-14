<?php

namespace SpotOnLive\Assertions\Helpers;

use SpotOnLive\Assertions\Services\AssertionServiceInterface;

class AssertionHelper
{
    /** @var \SpotOnLive\Assertions\Services\AssertionServiceInterface */
    protected $assertionService;

    public function __construct(AssertionServiceInterface $assertionService)
    {
        $this->assertionService = $assertionService;
    }

    /**
     * Check if action is granted
     *
     * @param $name
     * @param $user
     * @param array $data
     * @return bool
     */
    public function isGranted($name, $user, $data = [])
    {
        return $this->assertionService->isGranted($name, $user, $data);
    }
}
