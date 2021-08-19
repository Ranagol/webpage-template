<?php

namespace App\validators;

use App\Validators\AbstractValidator;
use App\Exceptions\ValidationException;

/**
 * This class contains functions that are used by LoginValidator 
 * and RegisterValidator too.
 */
abstract class AuthValidator extends AbstractValidator
{
    /**
     * Since a form is sending multiple input fields like email, password, username... 
     * We must collect in one place all the errors regarding these multiple input fields. 
     * This is the place where this collection is happening.
     *
     * @var array
     */
    protected $errors = [];
    
    /**
     * After the end of the validation process, this function checks if there are 
     * validation errors. If so, then it throws an extension.
     *
     * @return ValidationException | boolean
     */
    protected function checkForValidationErrors()
    {
        if (count($this->errors) > 0) {
            throw new ValidationException(json_encode($this->errors), 422);
        }

        return true;
    }

    /**
     * Input field validation function. 
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param [type] $email
     * @return void
     */
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

    /**
     * Input field validation function. 
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param [type] $password
     * @return void
     */
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

