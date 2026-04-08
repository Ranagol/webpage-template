<?php

declare(strict_types=1);

namespace App\Controllers\AuthControllers;

use App\Controllers\Controller;
use App\Exceptions\ValidationException;
use App\Models\User;
use App\Services\RegisterService;
use App\Validators\RegisterValidator;
use Illuminate\Database\QueryException;
use System\request\RequestInterface;

/**
 * Handles user registering stuff.
 */
class RegisterController extends Controller
{
    private RegisterService $registerService;

    public function __construct()
    {
        $this->registerService = new RegisterService();
    }

    /**
     * Loads the register page.
     */
    public function loadPage(): void
    {
        // Check if the user is already logged in, if yes then redirect him to home page.
        $this->registerService->redirectAlreadyLoggedInUser();

        // Load the register page.
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
     */
    public function register(RequestInterface $request): void
    {
        $requestData = $request->getAllRequestData();
        // Check CSRF token validity
        if (!validateCsrfToken($requestData['csrf_token'] ?? null)) {
            if (!headers_sent()) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            }
            echo 'Invalid CSRF token.';

            return;
        }

        // Extracting the registering data from the request
        $request = $request->getAllRequestData();
        $username = trim((string) ($request['username'] ?? ''));
        $firstname = trim((string) ($request['firstname'] ?? ''));
        $lastname = trim((string) ($request['lastname'] ?? ''));
        $email = strtolower(trim((string) ($request['email'] ?? '')));
        $password = $request['password'] ?? '';

        $hash = \password_hash($password, PASSWORD_DEFAULT);

        try {
            // data validation
            $this->validateUserData(
                $email,
                $password,
                $username,
                $firstname,
                $lastname
            );

            // creating user in db
            $user = new User();
            $user->email = $email;
            $user->password = $hash;
            $user->username = $username;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->save();

            // automatic login, after a successful registration
            $this->loginUser($email, $hash);

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
                ]
            );

        } catch (QueryException $exception) {

            // Gracefully handle duplicate email attempts without exposing DB internals.
            $this->view(
                'register',
                [
                    'errors' => [
                        'emailError' => 'This email is already registered.',
                    ],
                    'username' => $username,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                ]
            );
        }
    }

    /**
     * When a user is successfully authenticated, this function
     * automatically logs in the user, after the registration. Aka:
     * a newly registered user gets automatically logged in.
     */
    private function loginUser(string $email, string $hash): void
    {
        /**
         * The user is just freshly registered. We want to find this user in the db.
         */
        $user = User::where('email', '=', $email)->first();

        if (null !== $user) {
            if (PHP_SESSION_ACTIVE !== session_status()) {
                session_start();
            }

            // Regenerate session ID to prevent session fixation after auto-login.
            session_regenerate_id(true);

            $id = $user->id;
            $username = $user->username;

            /*
             * We store the users login status in the $_SESSION superglobal.
             */
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
        }
    }

    /**
     * Validates user data.
     *
     * @return void
     */
    private function validateUserData(
        string $email,
        string $password,
        string $username,
        string $firstname,
        string $lastname,
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
