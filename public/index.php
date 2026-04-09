<?php

declare(strict_types=1);

/**
 * Start session before any output or app code
 * “Start a session if:
 * 1-there is no active session
 * 2-AND we are not running tests (to avoid header issues in tests)”.
 */
if (PHP_SESSION_ACTIVE !== session_status() && (!defined('PHPUNIT_COMPOSER_INSTALL') && !getenv('PHPUNIT_RUNNING'))) {
    session_start();
}

use App\Application;

// No composer autoload, so we need to require the Application class manually, and then we can bootstrap the app.
require_once __DIR__ . '/../app/Application.php';

Application::bootstrap();
