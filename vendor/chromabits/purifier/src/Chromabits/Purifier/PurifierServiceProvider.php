<?php

namespace Chromabits\Purifier;

use Illuminate\Support\ServiceProvider;

/**
 * Class PurifierServiceProvider
 *
 * Registers a purifier service with default configuration
 *
 * You can modify this provider with your own to load custom
 * configuration
 *
 * Copyright (c) 2014 Eduardo Trujillo
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Purifier
 */
class PurifierServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind contract with concrete implementation
        $this->app->bind(
            'Chromabits\Purifier\Contracts\Purifier',
            function ($app) {
                return new Purifier(
                    $app['Illuminate\Contracts\Foundation\Application'],
                    $app['Illuminate\Contracts\Config\Repository']
                );
            }
        );
    }
}
