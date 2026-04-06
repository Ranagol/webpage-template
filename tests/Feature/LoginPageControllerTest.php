<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Application;
use App\Controllers\AuthControllers\LoginController;

final class LoginPageControllerTest extends TestCase
{
    public function testLoginPageLoadsView(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $controller = new LoginController();

        // Capture output
        ob_start();
        $controller->loadLoginPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the login view
        $this->assertStringContainsString('Please fill in your credentials to login.', $output);
        $this->assertStringContainsString('csrf_token', $output);
    }
}