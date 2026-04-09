<?php

declare(strict_types=1);

namespace App\Services;

use App\Application;
use App\Exceptions\DuplicateEmailException;
use App\Interfaces\RegisterServiceInterface;
use App\Interfaces\RegisterValidatorInterface;
use App\Models\User;

class RegisterService implements RegisterServiceInterface
{
    private RegisterValidatorInterface $registerValidator;

    public function __construct(RegisterValidatorInterface $registerValidator)
    {
        $this->registerValidator = $registerValidator;
    }

    public function checkForDuplicateEmail(string $email): void
    {
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            throw new DuplicateEmailException('Email already exists.');
        }
    }

    /**
     * Check if the user is already logged in, if yes then redirect him to home page.
     * The Application::redirect() is my custom function, defined in bootstrap.php.
     */
    public function redirectAlreadyLoggedInUser(): void
    {
        if (!empty($_SESSION['loggedin'])) {
            Application::redirect('/');
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
        $user = new User();
        $user->username = trim((string) ($requestData['username'] ?? ''));
        $user->firstname = trim((string) ($requestData['firstname'] ?? ''));
        $user->lastname = trim((string) ($requestData['lastname'] ?? ''));
        $user->email = strtolower(trim((string) ($requestData['email'] ?? '')));
        $user->password = $requestData['password'] ?? '';

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
    ): void {
        $this->registerValidator->validate(
            $email,
            $password,
            $username,
            $firstname,
            $lastname,
        );
    }

    /**
     * Hashes the user's password.
     */
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * When a user is successfully authenticated, this function
     * automatically logs in the user, after the registration. Aka:
     * a newly registered user gets automatically logged in.
     */
    public function loginUser(User $user): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Regenerate session ID to prevent session fixation after auto-login.
        session_regenerate_id(true);

        /*
            * We store the users login status in the $_SESSION superglobal.
            */
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $user->username;
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
