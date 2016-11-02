<?php

/**
 * Here we bootstrap a very small Laravel application for testing purposes
 */
$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/..')
);

return $app;
