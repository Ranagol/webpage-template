<?php

namespace App\controllers\authControllers;

use App\models\User;
use System\request\RequestInterface;


class LoginController
{
    public static function loadLoginPage()
    {
        return view('login');
    }

    public static function login(RequestInterface $request)
    {
        self::isUserAlreadyLoggedIn();

        //login data validation
        var_dump('login data validation started');
        $errors = Validator::validateLoginData($request);
        $request2 = $request->getAllRequestData();
        $email = $request2['email'];
        $password = $request2['password'];
        var_dump('login data validation finished');
        $t = 5;
        
        if ($errors !== false) {
            return view('login', compact('errors', 'email', 'password'));
        } 

        //authentication
        var_dump('authentication started');

        $requestData1 = $request->getAllRequestData();
        $email = $requestData1['email'];
        $password = $requestData1['password'];
        $user = User::where('email', '=', $email)->where('password', '=', $password)->first();
        // var_dump($user);
        if ($user === null) {
            var_dump('wrong user credentials...');
            $isAuthenticated = false;
            return view('login', compact('isAuthenticated'));
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

            return redirect('/home');
        } else {
            $isAuthenticated = false;
            return view('login', compact('isAuthenticated'));
        }
    }

    public static function logout()
    {
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
            var_dump('wrong user credentials...');
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

        
        if ($errors !== false) {
            return view('login', compact('errors', 'email', 'password'));
        } 
    }

    private static function isUserAlreadyLoggedIn()
    {
        // Check if the user is already logged in, if yes then redirect him to home page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            redirect('/home');
        }
    }
}

