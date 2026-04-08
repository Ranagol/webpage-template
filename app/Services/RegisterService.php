<?php

namespace App\Services;

class RegisterService
{
    public function checkCsrf(?string $csrfToken): void
    {
        if (!validateCsrfToken($csrfToken)) {
            if (!headers_sent()) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            }
            echo 'Invalid CSRF token.';

            return;
        }
    }

    /**
     * Check if the user is already logged in, if yes then redirect him to home page.
     * The redirect() is my custom function, defined in bootstrap.php.
     */
    public function redirectAlreadyLoggedInUser(): void
    {
        if (!empty($_SESSION['loggedin'])) {
            redirect('/');
        }
    }
}
