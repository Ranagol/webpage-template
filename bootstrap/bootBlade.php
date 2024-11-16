<?php

use Jenssegers\Blade\Blade;

$views = __DIR__ . '/../resources/views';
$cache = __DIR__ . '/cache';
$blade = new Blade($views, $cache);
// die(var_dump($blade));
// $GLOBALS['blade'] = $blade;