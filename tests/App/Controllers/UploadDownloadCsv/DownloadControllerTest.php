<?php

namespace Tests\App\Controllers\UploadDownloadCsv;

use App\Controllers\UploadDownloadCsv\DownloadController;
use PHPUnit\Framework\TestCase;

final class DownloadControllerTest extends TestCase
{
    public function testDownloadControllerIsLoadableAndExposesDownloadMethod(): void
    {
        $this->assertTrue(class_exists(DownloadController::class));

        $controller = new DownloadController();

        $this->assertInstanceOf(DownloadController::class, $controller);
        $this->assertContains('download', get_class_methods($controller));
    }
}
