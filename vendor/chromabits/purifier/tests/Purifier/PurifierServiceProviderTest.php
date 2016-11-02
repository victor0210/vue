<?php

namespace Chromabits\Tests\Purifier;

use Chromabits\Purifier\PurifierServiceProvider;
use Chromabits\Tests\TestCase;
use Illuminate\Config\Repository;
use Mockery as m;

/**
 * Class PurifierServiceProviderTest
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Tests\Purifier
 */
class PurifierServiceProviderTest extends TestCase
{
    public function testRegister()
    {
        // Setup testing config
        $config = new Repository([
            'purifier' => [
                'settings' => [
                    'myconfig' => [
                        'HTML.Allowed' => 'div,b,strong,i,em,a[href|title]'
                            . ',ul,ol,li,p[style],br,span[style]',
                        'AutoFormat.AutoParagraph' => false,
                    ]
                ]
            ]
        ]);
        $this->app->bind(
            'Illuminate\Contracts\Config\Repository',
            'Illuminate\Config\Repository'
        );
        $this->app->instance('Illuminate\Config\Repository', $config);

        // Create and register the provider
        $provider = new PurifierServiceProvider($this->app);
        $provider->register();

        // Assert that it works
        $this->assertTrue(
            $this->app->bound('Chromabits\Purifier\Contracts\Purifier')
        );
        $this->assertInstanceOf(
            'Chromabits\Purifier\Purifier',
            $this->app->make('Chromabits\Purifier\Contracts\Purifier')
        );
    }
}
