<?php

namespace App\Validators;

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
