<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\TrainController;
use PHPUnit\Framework\TestCase;

final class TrainControllerTest extends TestCase
{
    public function testTrainTask(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $trainController = new TrainController();

        // Capture output
        ob_start();
        $trainController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the train view
        $this->assertStringContainsString('Challenge 3: Train task (in terminal)', $output);
    }
}
