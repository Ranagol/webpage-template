<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Application;
use App\Controllers\MvcController;

final class MvcControllerTest extends TestCase
{
    public function testLoadPage(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $mvcController = new MvcController();

        // Capture output
        ob_start();
        $mvcController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the heroes and monsters view
        $this->assertStringContainsString('Challenge 1: Raw PHP MVC webpage', $output);
    }
}