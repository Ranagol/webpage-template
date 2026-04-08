<?php

declare(strict_types=1);

namespace App\Interfaces;

interface RegisterValidatorInterface
{
    public function validate(
        string $email,
        string $password,
        string $username,
        string $firstname,
        string $lastname,
    ): void;
}
