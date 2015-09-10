<?php

namespace SpotOnLive\Assertions;

interface AssertionInterface
{
    /**
     * Assert
     *
     * @param $user
     * @param array $data
     * @return boolean
     */
    public function assert($user, array $data = []);
}
