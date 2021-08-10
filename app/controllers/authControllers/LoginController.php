<?php

namespace App\controllers\authControllers;

use App\models\User;
use System\request\RequestInterface;


class LoginController
{
    /**
     * Loads the login page view.
     *
     * @return void
     */
    public static function loadLoginPage()
    {
        return view('login');
    }

    /**
     * Logs in the user.
     * First we check if the user is already logged in. If so, he will be redirected to the home page.
     * Secondly we do email and password validation. Example: if they are longer than 2 characters.
     * Thirdly we do authentication. We check if the email and password are the same, as the email 
     * and password from db.
     *
     * @param RequestInterface $request
     * @return void
     */
    public static function login(RequestInterface $request)
    {
        //check if the user is already logged in.
        self::isUserAlreadyLoggedIn();

        //login data validation
        $errors = Validator::validateLoginData($request);
        $request2 = $request->getAllRequestData();
        $email = $request2['email'];
        $password = $request2['password'];
        
        if ($errors !== false) {//TODO THIS HAS TO BE CORRECTED, USE EXCEPTIONS!!!!
            return view('login', compact('errors', 'email', 'password'));
        } 

        //authentication (are the email and the password = to the u and p from the db?)

        $requestData1 = $request->getAllRequestData();
        $email = $requestData1['email'];
        $password = $requestData1['password'];
        $user = User::where('email', '=', $email)->where('password', '=', $password)->first();
        if ($user === null) {
            $isAuthenticated = false;

            return view('login', compact('isAuthenticated'));
        }
        $emailFromDb = $user->email;
        $passwordFromDb = $user->password;


        if ($email === $emailFromDb && $password === $passwordFromDb) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username; 

            return redirect('users');
        } else {
            $isAuthenticated = false;

            return view('login', compact('isAuthenticated'));
        }
    }

    /**
     * Logs out a logged in user.
     *
     * @return void
     */
    public static function logout()
    {
        // Initialize the session
        session_start();
        
        // Unset all of the session variables
        $_SESSION = [];

        // Destroy the session.
        session_destroy();

        //Redirect to login page 
        redirect('login');
    }

    private static function authenticate(RequestInterface $request)
    {
        var_dump('authentication started');

        $request = $request->getAllRequestData();
        $email = $request['email'];
        $password = $request['password'];
        $user = User::where('email', '=', $email)->first();
        var_dump($user);
        if ($user === null) {
            var_dump('wrong user credentials...');//TODO THIS HAS TO BE CORRECTED, USE EXCEPTIONS!!!!
            return false;
        }
        $t = 4;
        $emailFromDb = $user->email;
        $passwordFromDb = $user->password;

        var_dump('authentication finished');

        if ($email === $emailFromDb && $password === $passwordFromDb) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username; 

            return true;
        } else {

            return false;
        }
    }

    private static function validateLoginData(RequestInterface $request)
    {
        //login data validation
        var_dump('login data validation started');
        $errors = Validator::validateLoginData($request);
        $request = $request->getAllRequestData();
        $email = $request['email'];
        $password = $request['password'];
        var_dump('login data validation finished');

        
        if ($errors !== false) {//TODO THIS HAS TO BE CORRECTED, USE EXCEPTIONS!!!!
            return view('login', compact('errors', 'email', 'password'));
        } 
    }

    /**
     * Check if the user is already logged in, if yes then redirect him to home page
     *
     */
    private static function isUserAlreadyLoggedIn()
    {
        // 
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            redirect('/');
        }
    }
}

