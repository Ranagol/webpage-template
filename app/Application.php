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

    /**
     * Starts session.
     */
    public static function run(): void
    {
        // Start session if not already started, and not running under PHPUnit (to avoid header issues in tests)
        if (!isset($_SESSION) && (!defined('PHPUNIT_COMPOSER_INSTALL') && !getenv('PHPUNIT_RUNNING'))) {
            session_start();
        }
        // Routing and output is handled by the router in bootstrap/bootstrap.php, in $this->bootstrap() 
    }
}