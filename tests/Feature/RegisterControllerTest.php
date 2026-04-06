<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\AuthControllers\RegisterController;
use PHPUnit\Framework\TestCase;

final class RegisterControllerTest extends TestCase
{
    public function testLoadPage(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $registerController = new RegisterController();

        // Capture output
        ob_start();
        $registerController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the register view
        $this->assertStringContainsString('Please fill this form to create an account.', $output);
        $this->assertStringContainsString('csrf_token', $output);
    }
}
