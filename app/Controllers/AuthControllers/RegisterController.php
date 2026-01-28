<?php

namespace App\Controllers\AuthControllers;

use App\controllers\Controller;
use App\models\User;
use System\request\RequestInterface;
use App\validators\RegisterValidator;
use App\Exceptions\ValidationException;

/**
 * Handles user registering stuff.
 */
class RegisterController extends Controller
{
    /**
     * Loads the register page.
     *
     * @return void
     */
    public function loadRegisterPage(): void
    {
        $this->view('register');
    }

    /**
     * Registers the user.
     * 
     * When a POST request arrives to the /register url, the router will trigger
     * this code: RegisterController::register(new WebPageRequest());
     * This is how we get the registering data into this method.
     * 
     * First we validate the user data (example: username must be longer than 3 characters.)
     * in case of validation errors here we return all input field values to be displayed 
     * again for the user, so he could correct them without typing everything from the 
     * beginning. If the validation is ok, a new user is created. Now, we have to
     * log in this new user. So, we find the user in the db, with the help if his
     * password and email, and we 'log him in', with the help of the session superglobal.
     * After this, we navigate the user to the home page.
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public function register(RequestInterface $request): void
    {
        //Extracting the registering data from the request
        $request = $request->getAllRequestData();
        $username = $request['username'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $password = $request['password'];
        $hash = \password_hash($password, PASSWORD_DEFAULT);

        try {
            //data validation
            $this->validateUserData(
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
            $this->loginUser($email, $hash);

            // returnView('home');
            $this->view('home');

        } catch (ValidationException $errors) {
            
            /**
             * in case of validation errors here we return 
             * 1 - the validation errors
             * 2 - all previous input field values to be displayed 
             * again for the user, so he could correct them without typing everything from the 
             * beginning.
             */
            $errors = json_decode($errors->getMessage(), true);

            $this->view(
                'register',
                [
                    'errors' => $errors,
                    'username' => $username,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password
                ]
            );  
        }
    }

    /**
     * When a user is succesfully authenticated, this function 
     * automatically logs in the user, after the registration. Aka: 
     * a newly registered user gets automatically logged in.
     *
     * @param string $email
     * @param string $password
     * 
     * @return void
     */
    private function loginUser(string $email,string $hash): void
    {
        /**
         * The user is just freshly registered. We want to find this user in the db.
         */
        $user = User::where('email', '=', $email)->where('password', '=', $hash)->first();
        
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        
        /**
         * We store the users login status in the $_SESSION superglobal.
         */
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
    private function validateUserData(
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
