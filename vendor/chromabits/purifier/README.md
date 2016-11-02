# [Purifier](https://github.com/etcinit/purifier) [![Build Status](https://travis-ci.org/etcinit/purifier.svg?branch=master)](https://travis-ci.org/etcinit/purifier)

A HTMLPurifier service for Laravel 5

## Installation

> Note: This package is for Laravel 5 only. It does not include a Facade and 
> it requires certain "Contracts" interfaces only available in Laravel 5. 

This package can be installed via [Composer](http://getcomposer.org) by 
requiring the `chromabits/purifier` package in your project's `composer.json`:

```json
{
    "require": {
        "laravel/framework": "~5.0",
        "chromabits/purifier": "~2.1"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

## Usage

To use the HTMLPurifier service, you must register the service provider when 
bootstrapping your Laravel application.

Find the `providers` key in `config/app.php` and register the HTMLPurifier 
Service Provider:

```php
    'providers' => [
        // ...
        'Chromabits\Purifier\PurifierServiceProvider',
    ]
```

After registering the provider, classes requiring the 
`Chromabits\Purifier\Contracts\Purifier` contract will get the purifier service 
instance through dependency injection (See below for examples).

## Configuration

To use your own settings, copy the `config/purifier.php` file in this package 
into your application's `config` directory, and modify as needed.

You can define mutiple sets of configurations by sspecifying new entries in the 
`settings` array key:

```php
return [
    "settings" => [
        "default" => [
            "HTML.SafeIframe" => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%",
        ],
        "titles" => [
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.Linkify' => false,
        ]
    ],
];
```

The service will use the `default` key as the default set of configuration, 
any other configuration will extend this. If a configuraiton file is not 
provided, the service will use safe defaults.

## Example

Full usage example with default settings within a Laravel 5 controller:

```php
<?php

namespace Http\Controllers;

use Chromabits\Purifier\Contracts\Purifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers;
 */
class IndexController {
	/**
	 * @var Purifier
	 */
	protected $purifier;
	
	/**
	 * Construct an instance of MyClass
	 *
	 * @param Purifier $purifier
	 */
	public function __construct(Purifier $purifier) {
		// Inject dependencies
		$this->purifier = $purifier;
	}
	
	/**
	 * Get index page
	 *
	 * @param Request $request
	 */
	public function getIndex(Request $request)
	{
		return $this->purifier->clean($request->input('first_name'));
	}
}
```

With dynamic configuration:

```php
	// Using config entries from purifier.php
	$this->purifier->clean('This is my H1 title', 'titles');
	
	// Passing configuration from an array (inherits default config)
	$this->purifier->clean(
		'This is my H1 title',
		[ 'Attr.EnableID' => true ]
	);
```

Interacting with the `HTMLPurifier_Config` object directly using a custom 
service provider and Closure:

```php
<?php

namespace App\Providers;

use Chromabits\Purifier\Purifier;
use Illuminate\Support\ServiceProvider;

/**
 * ...
 */
class CustomPurifierServiceProvider extends ServiceProvider
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
          		new Purifier($app, $app['config'], function (HTMLPurifier_Config $config) {
                		// Do stuff with $config here
                		return $config;
                }
            }
        );
    }
}
```

# License

Based on the 
[Laravel 4 Purifier service]((https://github.com/mewebstudio/purifier)) 

See **LICENSE.md** for license information
