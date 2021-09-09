<?php

namespace App\controllers\authControllers;

use App\models\User;
use System\request\RequestInterface;
use App\validators\RegisterValidator;
use App\Exceptions\ValidationException;

/**
 * Handles user registering stuff.
 */
class RegisterController
{
    /**
     * Loads the register page.
     *
     * @return void
     */
    public static function loadRegisterPage(): void
    {
        returnView('register');
    }

    /**
     * Registers the user.
     * First we validate the user data (example: username must be longer than 3 characters.)
     * in case of validation errors here we return all input field values to be displayed 
     * again for the user, so he could correct them without typing everything from the 
     * beginning. If the validation is ok, a new user is created. Now, we have to
     * log in this new user. So, we find the user in the db, with the help if his
     * password and email, and we 'log him in', with the help of the session superglobal.
     * After this, we navivate the user to the home page.
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public static function register(RequestInterface $request): void
    {
        $request = $request->getAllRequestData();
        $username = $request['username'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $password = $request['password'];
        $hash = \password_hash($password, PASSWORD_DEFAULT);

        try {
            //data validation
            self::validateUserData(
                $email, 
                $password,
                $username,
                $firstname,
                $lastname
            );



            //creating user in db
            $user = new User;
            $user->email = $email;
            $user->password = $hash;
            $user->username = $username;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->save();

            //automatic login, after a succesfull registratin
            self::loginUser($email, $hash);

            returnView('home');

        } catch (ValidationException $errors) {
        //in case of validation errors here we return all input field values to be displayed again for the user, so he could correct them without typing everything from the beginning
            $errors = json_decode($errors->getMessage(), true);
            
            returnView('register', compact(
                'errors', 
                'username',
                'firstname',
                'lastname',
                'email',
                'password'
            ));
        }
    }

    /**
     * When a user is succesfully authenticated, this function 
     * automatically logs in the user, after the registratio. Aka: 
     * a newly registered user gets automatically logged in.
     *
     * @param string $email
     * @param string $password
     * 
     * @return void
     */
    private static function loginUser(string $email,string $hash): void
    {
        $user = User::where('email', '=', $email)->where('password', '=', $hash)->first();
        
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user->id;
        $_SESSION["username"] = $user->username; 
    }

    /**
     * Validates user data.
     *
     * @param string $email
     * @param string $password
     * @param string $username
     * @param string $firstname
     * @param string $lastname
     * 
     * @return void
     */
    private static function validateUserData(
        string $email, 
        string $password,
        string $username,
        string $firstname,
        string $lastname
    ) {
        $registerValidator = new RegisterValidator();
        $registerValidator->validate(
            $email, 
            $password,
            $username,
            $firstname,
            $lastname,
        );
    }
}
