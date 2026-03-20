<?php

namespace Tests\App\Controllers\UploadDownloadCsv;

use App\Controllers\UploadDownloadCsv\UploadController;
use PHPUnit\Framework\TestCase;

final class UploadControllerTest extends TestCase
{
    public function testUploadControllerIsLoadableAndExposesPublicMethods(): void
    {
        $this->assertTrue(class_exists(UploadController::class));

        $controller = new UploadController();

        $this->assertInstanceOf(UploadController::class, $controller);
        $this->assertContains('displayUploadPage', get_class_methods($controller));
        $this->assertContains('store', get_class_methods($controller));
    }
}
