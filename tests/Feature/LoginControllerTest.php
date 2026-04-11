<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\AuthControllers\LoginController;
use App\Controllers\HomeController;
use App\Services\LoginService;
use App\Validators\LoginValidator;
use PHPUnit\Framework\TestCase;

final class LoginControllerTest extends TestCase
{
    public function testLoadPage(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $loginController = new LoginController(new LoginService(new LoginValidator()));

        // Capture output
        ob_start();
        $loginController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the login view
        $this->assertStringContainsString('Please fill in your credentials to login.', $output);
        $this->assertStringContainsString('csrf_token', $output);
    }

    public function testNavbarShowsLoggedInUser(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $homeController = new HomeController();

        // Simulate a logged-in user by setting session variables
        if (PHP_SESSION_ACTIVE !== session_status()) {
            session_start();
        }
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'TestUser';

        // Capture output
        ob_start();
        $homeController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains the username of the logged-in user
        $this->assertStringContainsString('Hi, TestUser', $output);

        // Clean up session
        session_unset();
        session_destroy();
    }

    public function testNavbarShowsYouAreNotLoggedInWhenNoUserIsLoggedIn(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $homeController = new HomeController();

        // Ensure no user is logged in by clearing session variables
        if (PHP_SESSION_ACTIVE !== session_status()) {
            session_start();
        }
        session_unset();
        session_destroy();

        // Capture output
        ob_start();
        $homeController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains the message for not logged-in users
        $this->assertStringContainsString('You are not logged in', $output);

        session_unset();
        session_destroy();
    }
}
