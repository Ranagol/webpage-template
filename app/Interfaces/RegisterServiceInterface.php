<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\User;

interface RegisterServiceInterface
{
    public function redirectAlreadyLoggedInUser(): void;

    public function checkCsrf(?string $csrfToken): void;

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
    public function extractDataFromRequest(array $requestData): User;

    public function validateUserData(
        string $email,
        string $password,
        string $username,
        string $firstname,
        string $lastname,
    ): void;

    public function loginUser(string $email): void;
}
