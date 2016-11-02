<?php

namespace Chromabits\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;

/**
 * Class TestCase
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Tests
 */
class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        return $app;
    }

    /**
     * Tear down tests
     */
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
