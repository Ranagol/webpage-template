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
        $this->validateEmail($email);
        $this->validatePassword($password);

        /*
         * Here we check if there are validation errors. If so, an exception is thrown.
         */
        $this->checkForValidationErrors();
    }
}
