<?php

declare(strict_types=1);

/**
 * A little explanation here: this bootstrap.php file is directly connected with a 'require' to the
 * main index.php. This means, that these functions from bootstrap.php will be available everywhere
 * in the app.
 */

// Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/../bootstrap/bootEloquent.php';

// router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../routes/routes.php';

// Here we do dotenv setup
require __DIR__ . '/../bootstrap/bootDotenv.php';

/**
 * Here we define our redirect() which will be used by controllers, similar to Laravel.
 *
 * @param string $path this is path/page, where we want to redirect our user
 */
function redirect(string $path): void
{
    $path = ltrim($path, '/'); // Remove leading slash if present
    /*
     * This is how redirect is done in vanilla php.
     */
    header("Location: /{$path}");

    // After sending the header, we need to exit, otherwise the code will continue to execute.
    exit;
}

/**
 * Returns a CSRF token and stores it in the current session. This is used on the frontend, to create
 * a CSRF token.FRONTEND.
 */
function createCsrfToken(): string
{
    // Check is session is started, if not, start it.
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Check is there is a csrf token in the session, and if it is a string.
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {

        // If not, create a new one and store it in the session.
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // Return the csrf token from the session to the frontend
    return $_SESSION['csrf_token'];
}

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
