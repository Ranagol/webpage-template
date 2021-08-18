<?php

namespace App\Validators;

class LoginValidator extends AuthValidator
{
    public function validate($email, $password)
    {
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->checkForValidationErrors();
    }
}
