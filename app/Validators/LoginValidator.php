<?php

declare(strict_types=1);

namespace App\Validators;

use App\Interfaces\LoginValidatorInterface;

/**
 * Password and email validation are the same for login and register. So, these two features
 * are in the parent AuthValidator, and not in the RegisterValidator or LoginValidator.
 */
class LoginValidator extends AuthValidator implements LoginValidatorInterface
{
    /**
     * Validates login data.
     */
    public function validate(string $email, string $password): void
    {
        $this->errors = [];
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->checkForValidationErrors();
    }
}
