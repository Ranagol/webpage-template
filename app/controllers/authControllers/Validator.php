<?php

namespace App\controllers\authControllers;

use System\request\RequestInterface;

class Validator
{
    public static $errors = [];

    public static function validate(RequestInterface $request)
    {
        $request = $request->getAllRequestData();

        $username = $request['username'];
        self::validateUsername($username);

        $firstname = $request['firstname'];
        self::validateFirstname($firstname);

        $lastname = $request['lastname'];
        self::validateLastname($lastname);

        $email = $request['email'];
        self::validateEmail($email);

        $password = $request['password'];
        self::validatePassword($password);
        $numberOfArrayKeys = count(self::$errors);

        if ($numberOfArrayKeys > 0) {

            return self::$errors;
        }

        return false;
    }

    private static function validateUsername($username)
    {
        $usernameError = null;

        if(empty($username)){
            $usernameError = "Please enter a username.";
        } elseif(strlen($username) <= 2 ){
            $usernameError = "Username must be longer than 2 characters.";
        }

        if($usernameError !== null){
            self::$errors['usernameError'] = $usernameError;
        }
    }

    private static function validateFirstname($firstname)
    {
        $firstnameError = null;

        if(empty($firstname)){
            $firstnameError = "Please enter a firstname.";
        } elseif(strlen($firstname) <=2 ){
            $firstnameError = "Firstname must be longer than 2 characters.";
        }

        if($firstnameError !== null){
            self::$errors['firstnameError'] = $firstnameError;
        }
    }

    private static function validateLastname($lastname)
    {
        $lastNameError = null;

        if(empty($lastname)){
            $lastNameError = "Please enter a lastname.";
        } elseif(strlen($lastname) <=2 ){
            $lastNameError = "Lastname must be longer than 2 characters.";
        }

        if($lastNameError !== null){
            self::$errors['lastNameError'] = $lastNameError;
        }
    }

    private static function validateEmail($email)
    {
        $emailError = null;

        if(empty($email)){
            $lastNameError = "Please enter an email.";
        } elseif(strlen($email) <=2 ){
            $emailError = "Email must be longer than 2 characters.";
        }

        if($emailError !== null){
            self::$errors['emailError'] = $emailError;
        }
    }

    private static function validatePassword($password)
    {
        $passwordError = null;

        if(empty($password)){
            $passwordError = "Please enter a password.";
        } elseif(strlen($password) <=2 ){
            $passwordError = "Password must be longer than 2 characters.";
        }

        if($passwordError !== null){
            self::$errors['passwordError'] = $passwordError;
        }
    }
 
    
    
    
    
    
    
    
        
}

