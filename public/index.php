<?php

declare(strict_types=1);

// Start session before any output or app code
if (PHP_SESSION_ACTIVE !== session_status() && (!defined('PHPUNIT_COMPOSER_INSTALL') && !getenv('PHPUNIT_RUNNING'))) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

use App\Application;

require_once __DIR__ . '/../app/Application.php';

Application::bootstrap();
Application::run();
