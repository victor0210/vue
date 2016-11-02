<?php

/**
 * This is an example configuration file for the service purifier service
 *
 * Include this in your app as config/purifier.php so that it is automatically
 * loaded
 */

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'preload' => false,
    'settings' => [
        'default' => [
            'HTML.Doctype' => 'XHTML 1.0 Strict',
            'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li'
                .',p[style],br,span[style],img[width|height|alt|src]',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style'
                .',font-family,text-decoration,padding-left,color'
                .',background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty' => true,
        ],
    ],
];
