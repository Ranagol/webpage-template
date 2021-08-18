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

        //getting email and password from the request
        $request = $request->getAllRequestData();
        $email = $request['email'];
        $password = $request['password'];

        //login data validation
        self::validateLoginData($email, $password);

        //finding the user
        $user = self::findUser($email, $password);

        //authenticate the user
        self::authenticateUser($user, $email, $password);
    }

    private static function authenticateUser(User $user, $email, $password)
    {
        //authentication (are the email and the password = to the u and p from the db?)
        $emailFromDb = $user->email;
        $passwordFromDb = $user->password;

        try {
            if ($email === $emailFromDb && $password === $passwordFromDb) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user->id;
                $_SESSION["username"] = $user->username; 
    
                return redirect('users');
            }
            throw new CantAuthenticateException('Can not authenticate this user: ' . $email);
        } catch (CantAuthenticateException $error) {
            $isAuthenticated = false;

            return view('login', compact('isAuthenticated'));
        }
    }

    private static function findUser($email, $password)
    {
        try {
            //check if there is a user with the validated email and password
            $user = User::where('email', '=', $email)->where('password', '=', $password)->first();
            if ($user === null) {
                throw new CantFindUserException(
                    'Can not find the user in the db during authentication. Users email is: ' . $email
                );
            }

            return $user;

        } catch (CantFindUserException $error) {
            $isAuthenticated = false;

            return view('login', compact('isAuthenticated'));
        }
    }

    private static function validateLoginData($email, $password)
    {
        try {
            $loginValidator = new LoginValidator();
            $loginValidator->validate($email, $password);
        } catch (\Exception $errors) {
            $errors = json_decode($errors->getMessage(), true);

            return view('login', compact('errors', 'email', 'password'));
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

    /**
     * Check if the user is already logged in, if yes then redirect him to home page
     *
     */
    private static function isUserAlreadyLoggedIn()
    {
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            redirect('/');
        }
    }
}
