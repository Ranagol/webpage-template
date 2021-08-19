<?php

namespace App\validators;

use App\Validators\AbstractValidator;
use App\Exceptions\ValidationException;

abstract class AuthValidator extends AbstractValidator
{
    protected $errors = [];
    
    protected function checkForValidationErrors()
    {
        if (count($this->errors) > 0) {
            throw new ValidationException(json_encode($this->errors), 422);
        }

        return true;
    }

    protected function validateEmail($email)
    {
        $emailError = null;

        if(empty($email)){
            $emailError = "Please enter an email.";
        } elseif(strlen($email) <=2 ){
            $emailError = "Email must be longer than 2 characters.";
        }

        if($emailError !== null){
            $this->errors['emailError'] = $emailError;
        }
    }

    protected function validatePassword($password)
    {
        $passwordError = null;

        if(empty($password)){
            $passwordError = "Please enter a password.";
        } elseif(strlen($password) <=2 ){
            $passwordError = "Password must be longer than 2 characters.";
        }

        if($passwordError !== null){
            $this->errors['passwordError'] = $passwordError;
        }
    }
}

