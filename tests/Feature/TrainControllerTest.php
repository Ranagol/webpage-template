<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Application;
use App\Controllers\TrainTaskController;

final class TrainControllerTest extends TestCase
{
    public function testTrainTask(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $controller = new TrainTaskController();

        // Capture output
        ob_start();
        $controller->trainTask();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the login view
        $this->assertStringContainsString('Challenge 3: Train task (in terminal)', $output);
    }
}