<?php

namespace App\controllers\authControllers;

use App\models\User;
use App\controllers\Controller;
use App\Validators\LoginValidator;
use System\request\RequestInterface;
use App\Exceptions\ValidationException;
use App\Exceptions\CantFindUserException;

class LoginController extends Controller
{
    /**
     * Loads the login page view.
     *
     * @return void
     */
    public function loadLoginPage(): void
    {
        $this->view('login');
    }

    /**
     * Logs in the user.
     * First we check if the user is already logged in. If so, he will be redirected to the home page.
     * Secondly we do email and password validation. Example: if they are longer than 2 characters.
     * Thirdly we do authentication. We check if the email and password are the same, as the email
     * and password from db.Now the loggin in is happening through the $_SESSION global variable.
     * Like this: 
     *       $_SESSION["loggedin"] = true;
     *       $_SESSION["id"] = $user->id;
     *       $_SESSION["username"] = $user->username;
     * We will store these user data in the session superglobal. And logging out is done by
     * deleting all the session data, and destroying the session.
     * 
     * @param RequestInterface $request
     * 
     * @return void
     */
    public function login(RequestInterface $request): void
    {
        //check if the user is already logged in. If so, the user will be redirected to home page.
        $this->isUserAlreadyLoggedIn();

        //getting email and password from the request
        $request = $request->getAllRequestData();
        $email = $request['email'];
        $password = $request['password'];

        try {

            /**
             * login data - email and password - validation.
             * A ValidationException will be thrown if there is a validation error.
             */
            $this->validateLoginData($email, $password);
            
            /**
             * finding the user in the db based on his unique email
             * CantFindUserException will be thrown, if the app can't find the user.
             */
            $user = $this->findUser($email);

            //authenticate the user - compare data from form with data from db
            $this->authenticateUser($user, $email, $password);

        } catch (ValidationException $errors) {

            /**
             * This is a case when we have an email or password validation error.
             */
            $errors = json_decode($errors->getMessage(), true);

            $this->view(
                'login',
                [
                    'errors' => $errors,
                    'email' => $email,
                    'password' => $password
                ]
            );

        } catch (CantFindUserException $error) {

            /**
             * This here is a case when the app can't find the user in the db. So the user that
             * wants to be authenticated, can't be authenticated. So, $isAuthenticated is false.
             */
            $isAuthenticated = false;

            $this->view('login', ['isAuthenticated' => $isAuthenticated]);
        }
    }

    /**
     * Checks if the email and the password from the input fields are = to the 
     * username and password from the db
     *
     * @param User $user
     * @param string $email
     * @param string $password
     * 
     * @return void
     */
    private function authenticateUser(
        User $user,
        string $email,
        string $password
    ): void
    {
        $emailFromDb = $user->email;
        $hashFromDb = $user->password;

        /**
         * If the email from the request and email from the db...
         * and
         * the password from the request and password from the db...
         * match, then this user is ok.
         */
        if ($email === $emailFromDb && \password_verify($password, $hashFromDb)) {

            /**
             * If there is no session, then start one.
             */
            if(!isset($_SESSION)){ 
                session_start(); 
            }

            /**
             * Put the users data into the session superglobal.
             */
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->id;
            $_SESSION["username"] = $user->username;
            $t = 8;

            redirect('users');
        }
    }

    /**
     * Tries to find the user based on the email
     * receved from the html form.
     *
     * @param string $email
     * 
     * @throws CantFindUserException
     * 
     * @return User
     */
    private function findUser(string $email): User
    {
        //check if there is a user with the validated email and password
        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            throw new CantFindUserException(
                'Can not find the user in the db during authentication. Users email is: ' . $email
            );
        }

        return $user;
    }

    /**
     * Validates login data.
     *
     * @param string $email
     * @param string $password
     * 
     * @return void
     */
    private function validateLoginData(string $email,string $password): void
    {
        $loginValidator = new LoginValidator();
        $loginValidator->validate($email, $password);
    }

    /**
     * Logs out a logged in user.
     *
     * @return void
     */
    public function logout(): void
    {
        // Initialize the session
        if(!isset($_SESSION)){ 
            session_start(); 
        }

        // Unset all of the session variables
        $_SESSION = [];

        // Destroy the session.
        session_destroy();

        //Redirect to login page
        redirect('login');
    }

    /**
     * Check if the user is already logged in, if yes then redirect him to home page.
     * The redirect() is my custom function, defined in bootstrap.php
     *
     * @return void
     */
    private function isUserAlreadyLoggedIn(): void
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            redirect('/');
        }
    }
}
