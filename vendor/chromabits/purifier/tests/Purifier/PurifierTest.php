<?php

namespace Chromabits\Tests\Purifier;

use Chromabits\Purifier\Purifier;
use Chromabits\Tests\TestCase;
use Exception;
use HTMLPurifier_Config;
use Illuminate\Config\Repository;
use Mockery as m;

/**
 * Class PurifierTest
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @package Chromabits\Tests\Purifier
 */
class PurifierTest extends TestCase
{
    public function testConstructorWithPreload()
    {
        $config = new Repository([
            'purifier' => [
                'preload' => true
            ]
        ]);

        new Purifier($this->app, $config);
    }

    public function testConstructor()
    {
        $config = new Repository([]);

        new Purifier($this->app, $config);
    }

    public function testClean()
    {
        $config = new Repository([]);

        $purifier = new Purifier($this->app, $config);

        $result = $purifier->clean('<script></script><p>Some string</p>');

        $this->assertEquals('<p>Some string</p>', $result);
    }

    public function testCleanWithArray()
    {
        $config = new Repository([]);

        $purifier = new Purifier($this->app, $config);

        $result = $purifier->clean([
            '<script></script><p>Some string</p>',
            '<script></script><p>Some other string</p>'
        ]);

        $this->assertEquals('<p>Some string</p>', $result[0]);
        $this->assertEquals('<p>Some other string</p>', $result[1]);
    }

    public function testCleanWithConfigFile()
    {
        $config = new Repository([
            'purifier' => [
                'settings' => [
                    'default' => [
                        'HTML.Doctype' => 'XHTML 1.0 Strict',
                        'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul'
                            . ',ol,li,p[style],br,span[style]'
                            . ',img[width|height|alt|src]',
                        'CSS.AllowedProperties' => 'font,font-size,font-weight'
                            . ',font-style,font-family,text-decoration'
                            . ',padding-left,color,background-color,text-align',
                        'AutoFormat.AutoParagraph' => false,
                        'AutoFormat.RemoveEmpty' => true,
                    ]
                ]
            ]
        ]);

        $purifier = new Purifier($this->app, $config);

        $result = $purifier->clean('<script></script>Some string');

        $this->assertEquals('Some string', $result);
    }

    public function testCleanWithConfigInheritance()
    {
        $config = new Repository([
            'purifier' => [
                'settings' => [
                    'myconfig' => [
                        'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul'
                            . ',ol,li,p[style],br,span[style]',
                        'AutoFormat.AutoParagraph' => false,
                    ]
                ]
            ]
        ]);

        $purifier = new Purifier($this->app, $config);

        $result = $purifier->clean(
            '<script></script>Some string<img />',
            'myconfig'
        );

        $this->assertEquals('Some string', $result);
    }

    public function testCleanWithConfigArray()
    {
        $config = new Repository([]);

        $purifier = new Purifier($this->app, $config);

        $result = $purifier->clean('<script></script>Some string<img />', [
            'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li'
                . ',p[style],br,span[style]',
            'AutoFormat.AutoParagraph' => false,
        ]);

        $this->assertEquals('Some string', $result);
    }

    public function testCleanWithCallback()
    {
        $config = new Repository([]);

        $purifier = new Purifier(
            $this->app,
            $config,
            function (HTMLPurifier_Config $config) {
                $config->loadArray([
                    'HTML.Doctype' => 'XHTML 1.0 Strict',
                    'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li'
                        . ',p[style],br,span[style]',
                    'CSS.AllowedProperties' => 'font,font-size,font-weight'
                        . ',font-style,font-family,text-decoration,padding-left'
                        . ',color,background-color,text-align',
                    'AutoFormat.AutoParagraph' => false,
                    'AutoFormat.RemoveEmpty' => true,
                ]);

                return $config;
            }
        );

        $result = $purifier->clean('<script></script>Some string<img />');

        $this->assertEquals('Some string', $result);
    }

    /**
     * @expectedException Exception
     */
    public function testCleanWithInvalidSetting()
    {
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

        $purifier = new Purifier($this->app, $config);

        $result = $purifier->clean(
            '<script></script>Some string<img />',
            'myconfig2'
        );

        $this->assertEquals('Some string', $result);
    }
}
