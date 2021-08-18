<?php

namespace App\controllers\authControllers;

use App\models\User;
use System\request\RequestInterface;


class RegisterController
{
    /**
     * Loads the register page.
     *
     * @return void//TODO LOSI mit kell ide tenni? View lesz returnolva...
     */
    public static function loadRegisterPage()
    {
        return view('register');
    }

    /**
     * Registers the user.
     * First we validate the user data (example: username must be longer than 3 characters.)
     * in case of validation errors here we return all input field values to be displayed 
     * again for the user, so he could correct them without typing everything from the 
     * beginning. If the validation is ok, a new user is created. Now, we have to
     * log in this new user. So, we find the user in the db, with the help if his
     * password and email, and we 'log him in', with the help of the session superglobal.
     *
     * @param RequestInterface $request
     * @return void
     */
    public static function register(RequestInterface $request)
    {
        $errors = Validator::validateRegisterData($request);
        $request = $request->getAllRequestData();
        $username = $request['username'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $password = $request['password'];

        //in case of validation errors here we return all input field values to be displayed again for the user, so he could correct them without typing everything from the beginning
        if ($errors) {
            return view('register', compact(
                'errors', 
                'username',
                'firstname',
                'lastname',
                'email',
                'password'
            ));
        }

        User::create($request);

        //automatic login, after a succesfull registratin
        $user = User::where('email', '=', $email)->where('password', '=', $password)->first();
        session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username; 
        
        return view('home');
    }
}
