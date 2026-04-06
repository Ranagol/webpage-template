<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Application;
use App\Controllers\UploadDownloadCsv\UploadController;

final class UploadControllerTest extends TestCase
{
    public function testLoadPage(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $uploadController = new UploadController();

        // Capture output
        ob_start();
        $uploadController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the upload view
        $this->assertStringContainsString('Challenge 2: File Upload & Processing', $output);
        $this->assertStringContainsString('csrf_token', $output);
    }
}