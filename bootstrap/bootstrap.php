<?php

declare(strict_types=1);

// Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/../bootstrap/bootEloquent.php';

// router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../routes/routes.php';

// Here we do dotenv setup
require __DIR__ . '/../bootstrap/bootDotenv.php';

/**
 * BACKEND.
 */
function checkCsrfToken(?string $tokenFromFrontend): void
{
    if (!validateCsrfToken($tokenFromFrontend)) {
        if (!headers_sent()) {
            http_response_code(403);
        }

        exit('Invalid CSRF token.');
    }
}

/**
 * Validates an incoming CSRF token against the one in the current session. This is used on the
 * backend, in controllers. BACKEND.
 */
function validateCsrfToken(?string $tokenFromFrontend): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // If the csrf token from frontend is an empty string or null, return false.
    if ($tokenFromFrontend === '' || $tokenFromFrontend === null) {
        return false;
    }

    // If there is no csrf token in the session, or it is not a string, return false.
    $backendToken = $_SESSION['csrf_token'] ?? null;
    if (!isset($backendToken) || !is_string($backendToken)) {
        return false;
    }

    // Compare the csrf token from the frontend with the one in the session (backend)
    // Returns TRUE when the two strings are equal, FALSE otherwise.
    return hash_equals($backendToken, $tokenFromFrontend);
}
