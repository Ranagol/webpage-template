<?php

namespace App\Validators;

/**
 * Password and email validation are the same for login and register. So, these two features
 * are in the parent AuthValidator, and not in the RegisterValidator or LoginValidator.
 */
class LoginValidator extends AuthValidator
{
    /**
     * Validates login data.
     *
     * @param string $email
     * @param string $password
     * 
     * @return void
     */
    public function validate(string $email,string $password): void
    {
        $this->validateEmail($email);
        $this->validatePassword($password);

        /**
         * Here we check if there are validation errors. If so, an exception is thrown.
         */
        $this->checkForValidationErrors();
    }
}
