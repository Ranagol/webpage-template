<?php

namespace App\Validators;

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
        $this->checkForValidationErrors();
    }
}
