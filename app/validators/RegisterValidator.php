<?php

namespace App\Validators;

/**
 * Validates email, password, firstname...
 * 
 * Inherits from AuthValidator parent the exception throwing ability.
 * 
 * Password and email validation are the same for login and register. 
 * So, these two features* are in the parent AuthValidator, and not in the RegisterValidator or 
 * LoginValidator.
 */
class RegisterValidator extends AuthValidator
{
    /**
     * Validates register data.
     *
     * @param string $email
     * @param string $password
     * @param string $username
     * @param string $firstname
     * @param string $lastname
     * 
     * @return void
     */
    public function validate(
        string $email, 
        string $password,
        string $username,
        string $firstname,
        string $lastname
    ): void{
        $this->validateUsername($username);
        $this->validateFirstname($firstname);
        $this->validateLastname($lastname);
        $this->validateEmail($email);
        $this->validatePassword($password);

        /**
         * Here we check if there are validation errors. If so, an exception is thrown.
         */
        $this->checkForValidationErrors();
    }

    /**
     * Input field validation function. 
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param string $username
     * 
     * @return void
     */
    private function validateUsername($username): void
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

    /**
     * Input field validation function. 
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param string $firstname
     * 
     * @return void
     */
    private function validateFirstname($firstname): void
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

    /**
     * Input field validation function. 
     * Any new validation rules should be added with a new elseif at the end.
     *
     * @param string $lastname
     * 
     * @return void
     */
    private function validateLastname($lastname): void
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
