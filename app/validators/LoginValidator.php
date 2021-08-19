<?php

namespace App\Validators;

class LoginValidator extends AuthValidator
{
    /**
     * Validates login data.
     *
     * @param [type] $email
     * @param [type] $password
     * @return void
     */
    public function validate($email, $password)
    {
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->checkForValidationErrors();
    }
}
