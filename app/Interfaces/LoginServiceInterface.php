<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\User;

interface LoginServiceInterface
{
    public function checkCsrf(?string $csrfToken): void;

    public function authenticateUser(
        User $user,
        string $email,
        string $password,
    ): bool;

    public function findUser(string $email): User;

    public function validateLoginData(string $email, string $password): void;

    public function redirectAlreadyLoggedInUser(): void;
}
