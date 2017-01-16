<?php

namespace Chromabits\Purifier\Contracts;

/**
 * Interface Purifier
 *
 * A contract defining the behavior of a purifier service
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Purifier\Contracts
 */
interface Purifier
{
    /**
     * Purify the HTML in the input string or array of strings
     *
     * @param array|string $dirty HTML to clean
     * @param array|string $config
     *
     * @return array|string
     * @throws \Exception
     */
    public function clean($dirty, $config = null);
}
