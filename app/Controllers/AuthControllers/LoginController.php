<?php

declare(strict_types=1);

namespace App\Controllers\AuthControllers;

use App\Application;
use App\Controllers\Controller;
use App\Exceptions\CantFindUserException;
use App\Exceptions\ValidationException;
use App\Interfaces\LoginServiceInterface;
use System\request\RequestInterface;

class LoginController extends Controller
{
    private LoginServiceInterface $loginService;

    public function __construct(LoginServiceInterface $loginService)
    {
        parent::__construct();
        $this->loginService = $loginService;
    }

    /**
     * Loads the login page view.
     */
    public function loadPage(): void
    {
        // If the user is already logged in, then redirect him to home page.
        $this->loginService->redirectAlreadyLoggedInUser();

        // Display the login page view
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
     */
    public function login(RequestInterface $request): void
    {
        $requestData = $request->getAllRequestData();

        // Check CSRF token validity
        $csrfToken = $requestData['csrf_token'] ?? null;
        checkCsrfToken($csrfToken);

        // check if the user is already logged in. If so, the user will be redirected to home page.
        $this->loginService->redirectAlreadyLoggedInUser();

        $email = $requestData['email'] ?? '';
        $password = $requestData['password'] ?? '';

        try {
            // Validate login data (throws ValidationException on error)
            $this->loginService->validateLoginData($email, $password);

            // Find user by email (throws CantFindUserException on error)
            $user = $this->loginService->findUser($email);

            // Authenticate user
            $isAuthenticated = $this->loginService->authenticateUser($user, $email, $password);

            if ($isAuthenticated === false) {
                $this->view('login', ['isAuthenticated' => false, 'email' => $email]);

                return;
            }

            // If authenticated, redirect to home page
            Application::redirect('/');

        } catch (ValidationException $validationException) {
            $this->view(
                'login',
                [
                    'errors' => $validationException->getErrors(),
                    'email' => $email,
                ]
            );

            return;
        } catch (CantFindUserException $cantFindUserException) {
            $isAuthenticated = false;
            $this->view('login', ['isAuthenticated' => $isAuthenticated]);

            return;
        }
    }

    /**
     * Logs out a logged in user.
     */
    public function logout(): void
    {
        $csrfToken = $_POST['csrf_token'] ?? null;
        checkCsrfToken($csrfToken);

        // Initialize the session
        if (PHP_SESSION_ACTIVE !== session_status()) {
            session_start();
        }

        // Unset all of the session variables
        $_SESSION = [];

        // Destroy the session.
        session_destroy();

        // Redirect to login page
        Application::redirect('login');
    }
}
