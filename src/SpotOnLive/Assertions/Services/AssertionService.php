<?php

/**
 * Assertions for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\EntrustDoctrineORM
 */

namespace SpotOnLive\Assertions\Services;

use Illuminate\Foundation\Application;
use SpotOnLive\EntrustDoctrineORM\Exceptions;
use SpotOnLive\Assertions\Exceptions\AssertionNotFoundException;

class AssertionService implements AssertionServiceInterface
{
    /** @var array */
    protected $assertions = [];

    public function __construct(array $assertions = [])
    {
        $this->assertions = $assertions;
    }

    /**
     * Check if permissions is granted
     *
     * @param $name
     * @param $user
     * @param array $data
     * @return bool
     * @throws AssertionNotFoundException
     */
    public function isGranted($name, $user, array $data = [])
    {
        if (!array_key_exists($name, $this->assertions)) {
            throw new AssertionNotFoundException(sprintf(_('The assertion \'%s\' does not exist'), $name));
        }

        $assertionClass = $this->assertions[$name];

        if (!class_exists($assertionClass)) {
            throw new AssertionNotFoundException(sprintf(_('The assertion class \'%s\' does not exist'), $assertionClass));
        }

        /** @var \SpotOnLive\Assertions\AssertionInterface $assertion */
        $assertion = new $assertionClass;

        return $assertion->assert($user, $data);
    }
}