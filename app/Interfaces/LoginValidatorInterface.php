<?php

declare(strict_types=1);

namespace App\Interfaces;

interface LoginValidatorInterface
{
    public function validate(
        string $email,
        string $password,
    ): void;
}
