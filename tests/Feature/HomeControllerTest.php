<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Application;
use App\Controllers\HomeController;

final class HomeControllerTest extends TestCase
{
    public function testHomeLoadsView(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $controller = new HomeController();

        // Capture output
        ob_start();
        $controller->home();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the home view
        $this->assertStringContainsString('PHP MVC Web Application', $output);
        // $this->assertStringContainsString('csrf_token', $output);
    }
}