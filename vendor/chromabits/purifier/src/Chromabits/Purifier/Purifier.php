<?php

/**
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * ---
 *
 * Modified for the Laravel 4 HTMLPurifier package
 * Copyright (c) 2013 MeWebStudio
 * Muharrem ERİN <me@mewebstudio.com> http://www.mewebstudio.com
 * http://www.gnu.org/licenses/lgpl-2.1.html GNU Lesser General Public License,
 * version 2.1
 *
 * ---
 *
 * Modified for the Laravel 5 HTMLPurifier package
 * Copyright (c) 2014 Eduardo Trujillo
 */

namespace Chromabits\Purifier;

use Chromabits\Purifier\Contracts\Purifier as PurifierContract;
use Closure;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class Purifier
 *
 * Service for purifying HTML strings or arrays of strings
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Purifier
 */
class Purifier implements PurifierContract
{
    const LIBRARY_PATH = 'vendor/ezyang/htmlpurifier/library/';

    const PRELOAD_FILE = 'HTMLPurifier.includes.php';
    const AUTOLOAD_FILE = 'HTMLPurifier.auto.php';

    /**
     * Implementation of the Laravel application
     *
     * @var Application
     */
    protected $app;

    /**
     * Application configuration repository
     *
     * @var Repository
     */
    protected $config;

    /**
     * @var callable
     */
    protected $configCallback;

    /**
     * Internal purifier
     *
     * @var HTMLPurifier
     */
    protected $purifier;

    /**
     * Configuration sets
     *
     * @var array
     */
    protected $configurations;

    /**
     * Construct an instance of a Purifier
     *
     * @param Application $app
     * @param Repository $config
     * @param callable $configCallback
     */
    public function __construct(
        Application $app,
        Repository $config,
        Closure $configCallback = null
    ) {
        // Inject dependencies
        $this->app = $app;

        $this->config = $config;

        $this->configCallback = $configCallback;

        // Initialize configurations array
        $this->configurations = [];

        // Initialize the purifier
        $this->init();
    }

    /**
     * Initialize the purifier
     */
    protected function init()
    {
        $this->includeLibrary();

        $this->configurations['default'] = $this->configure();

        $this->purifier = new HTMLPurifier($this->configurations['default']);
    }

    /**
     * Prepare configuration for the HTMLPurifier
     *
     * @return HTMLPurifier_Config
     */
    protected function configure()
    {
        // Create new configuration object
        $config = HTMLPurifier_Config::createDefault();

        $config->autoFinalize = $this->config->get('purifier.finalize', true);

        $config->set(
            'Core.Encoding',
            $this->config->get('purifier.encoding', 'UTF-8')
        );

        // Attempt to load default settings fro configuration file
        if (is_array($this->config->get('purifier.settings.default', ''))) {
            $config->loadArray($this->config->get('purifier.settings.default'));
        } else {
            $config->loadArray($this->getDefaultConfig());
        }

        // Call a custom configuration function (if provided)
        if (is_callable($this->configCallback)) {
            $callback = $this->configCallback;

            $config = $callback($config);
        }

        return $config;
    }

    /**
     * Get a fallback set of configuration when a configuration file is not
     * available
     *
     * @return array
     */
    protected function getDefaultConfig()
    {
        return [
            'HTML.Doctype' => 'XHTML 1.0 Strict',
            'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li'
                . ',p[style],br,span[style],img[width|height|alt|src]',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style'
                . ',font-family,text-decoration,padding-left,color'
                . ',background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty' => true,
        ];
    }

    /**
     * Includes the HTMLPurfifier library
     */
    protected function includeLibrary()
    {
        // Check that the Purifier classes haven't been already loaded
        if (!class_exists('HTMLPurifier_Config', false)) {
            // Optionally preload the purifier libraries
            if ($this->config->get('purifier.preload', false)) {
                require $this->getLibraryPath(self::PRELOAD_FILE);
            }

            // Load the autoloader
            require $this->getLibraryPath(self::AUTOLOAD_FILE);
        }
    }

    /**
     * Get the path to the HTMLPurifier library
     *
     * @param string $path
     *
     * @return string
     */
    protected function getLibraryPath($path = '')
    {
        $basePath = $this->app['path.base'];

        $libraryPath = $basePath . '/' . self::LIBRARY_PATH
            . ($path ? '/' . $path : $path);

        return $libraryPath;
    }

    /**
     * Load configuration set for the purifier
     *
     * @param array|string $config
     *
     * @return HTMLPurifier_Config
     * @throws Exception
     */
    protected function loadConfigurationSet($config)
    {
        // Check if it is an array
        if (is_array($config)) {
            return $this->inheritConfiguration($config);
        }

        // Check if it is already loaded
        if (isset($this->configurations[$config])) {
            return $this->configurations[$config];
        }

        // Check and load setting from configuration file
        if ($this->config->has('purifier.settings.' . $config)) {
            $this->configurations[$config] = $this->inheritConfiguration(
                $this->config->get('purifier.settings.' . $config)
            );

            return $this->configurations[$config];
        }

        throw new Exception('Purifier configuration set not found');
    }

    /**
     * Inherit default configuration
     *
     * @param array $config
     *
     * @return HTMLPurifier_Config
     */
    protected function inheritConfiguration(array $config)
    {
        $configuration = HTMLPurifier_Config::inherit(
            $this->configurations['default']
        );

        $configuration->loadArray($config);

        return $configuration;
    }

    /**
     * Purify the HTML in the input string or array of strings
     *
     * @param array|string $dirty HTML to clean
     * @param array|string $config
     *
     * @return array|string
     * @throws Exception
     */
    public function clean($dirty, $config = 'default')
    {
        $self = $this;

        if (is_array($dirty)) {
            return array_map(function ($item) use ($self) {
                return $self->clean($item);
            }, $dirty);
        }

        $config = $this->loadConfigurationSet($config);

        return $this->purifier->purify($dirty, $config);
    }
}
