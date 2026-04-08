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
        if (getenv('APP_ENV') === 'local') {
            // Show all errors EXCEPT deprecated warnings
            error_reporting(E_ALL & ~E_DEPRECATED);
            // Shows runtime errors directly in the browser output
            ini_set('display_errors', '1');
            // Shows errors that happen during PHP startup
            ini_set('display_startup_errors', '1');
        }

        // Show all errors EXCEPT deprecated warnings
        error_reporting(E_ALL & ~E_DEPRECATED);
        // Shows runtime errors directly in the browser output
        ini_set('display_errors', '1');
        // Shows errors that happen during PHP startup
        ini_set('display_startup_errors', '1');

        // Autoload
        require_once __DIR__ . '/../vendor/autoload.php';

        // Bootstrap helpers, config, routes, etc.Routing is triggered here.
        require_once __DIR__ . '/../bootstrap/bootstrap.php';
    }
}
