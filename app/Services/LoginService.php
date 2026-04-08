<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\CantFindUserException;
use App\Interfaces\LoginServiceInterface;
use App\Interfaces\LoginValidatorInterface;
use App\Models\User;
use App\Validators\LoginValidator;

class LoginService implements LoginServiceInterface
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
     * Checks if the email and the password from the input fields are = to the
     * username and password from the db.
     */
    public function authenticateUser(
        User $user,
        string $email,
        string $password,
    ): bool {
        $emailFromDb = $user->email;
        $hashFromDb = $user->password;

        /*
         * If the email from the request and email from the db...
         * and
         * the password from the request and password from the db...
         * match, then this user is ok.
         */
        if ($email === $emailFromDb && \password_verify($password, $hashFromDb)) {

            /*
             * If there is no session, then start one.
             */
            if (PHP_SESSION_ACTIVE !== session_status()) {
                session_start();
            }

            // Regenerate session ID to prevent session fixation after login.
            session_regenerate_id(true);

            /*
             * Put the users data into the session superglobal.
             */
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user->id;
            $_SESSION['username'] = $user->username;

            return true;
        }

        return false;
    }

    /**
     * Tries to find the user based on the email
     * receved from the html form.
     *
     * @throws CantFindUserException
     */
    public function findUser(string $email): User
    {
        // check if there is a user with the validated email and password
        $user = User::where('email', '=', $email)->first();
        if ($user instanceof User) {
            return $user;
        }

        throw new CantFindUserException('User not found.');
    }

    /**
     * Validates login data.
     */
    public function validateLoginData(
        string $email,
        string $password,
        LoginValidatorInterface $loginValidator = new LoginValidator(),
    ): void {
        $loginValidator->validate($email, $password);
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
