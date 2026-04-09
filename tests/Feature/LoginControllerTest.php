<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\AuthControllers\LoginController;
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
}
