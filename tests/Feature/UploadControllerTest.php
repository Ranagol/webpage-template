<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\UploadDownloadCsv\UploadController;
use PHPUnit\Framework\TestCase;

final class UploadControllerTest extends TestCase
{
    public function testLoadPage(): void
    {
        Application::bootstrap();
        $uploadController = new UploadController();
        ob_start();
        $uploadController->loadPage();
        $output = ob_get_clean();
        $this->assertStringContainsString('Challenge 2: File Upload & Processing', $output);
        $this->assertStringContainsString('csrf_token', $output);
    }
}
