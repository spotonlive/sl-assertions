<?php

/**
 * Assertions for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\EntrustDoctrineORM
 */

namespace SpotOnLive\Assertions\Services;

use SpotOnLive\Assertions\Exceptions\AssertionNotFoundException;

interface AssertionServiceInterface
{
    /**
     * Check if action is granted
     *
     * @param $name
     * @param $user
     * @param array $data
     * @return bool
     * @throws AssertionNotFoundException
     */
    public function isGranted($name, $user, array $data = []);
}
