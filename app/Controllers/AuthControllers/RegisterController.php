<?php

declare(strict_types=1);

namespace App\Controllers\AuthControllers;

use App\Application;
use App\Controllers\Controller;
use App\Exceptions\DuplicateEmailException;
use App\Exceptions\ValidationException;
use App\Interfaces\RegisterServiceInterface;
use System\request\RequestInterface;

/**
 * Handles user registering stuff.
 */
class RegisterController extends Controller
{
    private RegisterServiceInterface $registerService;

    public function __construct(RegisterServiceInterface $registerService)
    {
        parent::__construct();
        $this->registerService = $registerService;
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
        $csrfToken = $requestData['csrf_token'] ?? null;
        checkCsrfToken($csrfToken);

        $user = $this->registerService->extractDataFromRequest($requestData);

        try {

            $this->registerService->checkForDuplicateEmail($user->email);

            // This below is for testing purposes, to avoid the registration form validation every time, when I want to test the login functionality. So, instead of extracting the user data from the request, I return a test user with valid data. This way I can easily test the login functionality, without going through the registration form every time.
            // $user = $this->registerService->returnTestUser();

            $this->registerService->validateUserData(
                $user->email,
                $user->password,
                $user->username,
                $user->firstname,
                $user->lastname
            );

            $hashedPassword = $this->registerService->hashPassword($user->password);
            $user->password = $hashedPassword;

            $user->save();

            // automatic login, after a successful registration
            $this->registerService->loginUser($user);

            // Redirect to home page after successful registration and login
            Application::redirect('/');

        } catch (ValidationException $validationException) {

            /*
             * in case of validation errors here we return
             * 1 - the validation errors
             * 2 - all previous input field values to be displayed
             * again for the user, so he could correct them without typing everything from the
             * beginning.
             */
            $this->view(
                'register',
                [
                    'errors' => $validationException->getErrors(),
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                ]
            );

        } catch (DuplicateEmailException $exception) {

            // Gracefully handle duplicate email attempts without exposing DB internals.
            $this->view(
                'register',
                [
                    'errors' => [
                        'emailError' => 'This email is already registered.',
                    ],
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                ]
            );
        }
    }
}
