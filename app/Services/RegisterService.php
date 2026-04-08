<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\RegisterServiceInterface;
use App\Interfaces\RegisterValidatorInterface;
use App\Models\User;
use App\Validators\RegisterValidator;

class RegisterService implements RegisterServiceInterface
{
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

    public function checkCsrf(?string $csrfToken): void
    {
        if (!validateCsrfToken($csrfToken)) {
            if (!headers_sent()) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            }
            echo 'Invalid CSRF token.';

            exit;
        }
    }

    /**
     * Extracts user data from the registration request array and returns a User instance.
     *
     * @param array{
     *   username?: string,
     *   firstname?: string,
     *   lastname?: string,
     *   email?: string,
     *   password?: string
     * } $requestData
     */
    public function extractDataFromRequest(array $requestData): User
    {
        // Extracting the registering data from the request
        $password = $requestData['password'] ?? '';
        $hash = \password_hash($password, PASSWORD_DEFAULT);

        $user = new User();
        $user->username = trim((string) ($requestData['username'] ?? ''));
        $user->firstname = trim((string) ($requestData['firstname'] ?? ''));
        $user->lastname = trim((string) ($requestData['lastname'] ?? ''));
        $user->email = strtolower(trim((string) ($requestData['email'] ?? '')));
        $user->password = $hash;

        return $user;
    }

    /**
     * Validates user data.
     */
    public function validateUserData(
        string $email,
        string $password,
        string $username,
        string $firstname,
        string $lastname,
        RegisterValidatorInterface $registerValidator = new RegisterValidator(),
    ): void {
        $registerValidator->validate(
            $email,
            $password,
            $username,
            $firstname,
            $lastname,
        );
    }

    /**
     * When a user is successfully authenticated, this function
     * automatically logs in the user, after the registration. Aka:
     * a newly registered user gets automatically logged in.
     */
    public function loginUser(string $email): void
    {
        /**
         * The user is just freshly registered. We want to find this user in the db.
         */
        $user = User::where('email', '=', $email)->first();

        if (null !== $user) {
            if (PHP_SESSION_ACTIVE !== session_status()) {
                session_start();
            }

            // Regenerate session ID to prevent session fixation after auto-login.
            session_regenerate_id(true);

            $id = $user->id;
            $username = $user->username;

            /*
             * We store the users login status in the $_SESSION superglobal.
             */
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
        }
    }

    public function returnTestUser(): User
    {
        $user = new User();
        $user->username = 'testuser@gmail.com';
        $user->firstname = 'testuser@gmail.com';
        $user->lastname = 'testuser@gmail.com';
        $user->email = 'testuser@gmail.com';
        $user->password = password_hash('password', PASSWORD_DEFAULT);

        return $user;
    }
}
