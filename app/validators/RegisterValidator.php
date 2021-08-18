<?php

namespace App\Validators;

class RegisterValidator extends AuthValidator
{
    public function validate(
        $email, 
        $password,
        $username,
        $firstname,
        $lastname
    ){
        $this->validateUsername($username);
        $this->validateFirstname($firstname);
        $this->validateLastname($lastname);
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->checkForValidationErrors();
    }

    private function validateUsername($username)
    {
        $usernameError = null;

        if(empty($username)){
            $usernameError = "Please enter a username.";
        } elseif(strlen($username) <= 2 ){
            $usernameError = "Username must be longer than 2 characters.";
        }

        if($usernameError !== null){
            $this->errors['usernameError'] = $usernameError;
        }
    }

    private function validateFirstname($firstname)
    {
        $firstnameError = null;

        if(empty($firstname)){
            $firstnameError = "Please enter a firstname.";
        } elseif(strlen($firstname) <=2 ){
            $firstnameError = "Firstname must be longer than 2 characters.";
        }

        if($firstnameError !== null){
            $this->errors['firstnameError'] = $firstnameError;
        }
    }

    private function validateLastname($lastname)
    {
        $lastNameError = null;

        if(empty($lastname)){
            $lastNameError = "Please enter a lastname.";
        } elseif(strlen($lastname) <=2 ){
            $lastNameError = "Lastname must be longer than 2 characters.";
        }

        if($lastNameError !== null){
            $this->errors['lastNameError'] = $lastNameError;
        }
    }
}
