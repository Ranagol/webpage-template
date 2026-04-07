<?php

declare(strict_types=1);

namespace App;

/**
 * Application bootstrap and runner for web and test environments.
 */
class Application
{
    /**
     * Bootstrap the app (autoload, config, helpers, etc).
     * Does NOT start session or output anything.
     * We need this function, because we want to be able to bootstrap the app in both web and test
     * environments. Reminder: the feature tests are running without triggering the index.php, so we
     * need a way to bootstrap the app in the tests as well, and this is what this function does.
     */
    public static function bootstrap(): void
    {
        // Suppress deprecation warnings from older packages
        error_reporting(E_ALL & ~E_DEPRECATED);

        // Autoload
        require_once __DIR__ . '/../vendor/autoload.php';

        // Bootstrap helpers, config, routes, etc.Routing is triggered here.
        require_once __DIR__ . '/../bootstrap/bootstrap.php';
    }
}
