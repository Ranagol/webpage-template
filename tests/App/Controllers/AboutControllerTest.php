<?php

namespace Tests\App\Controllers;

use App\Controllers\AboutController;
use PHPUnit\Framework\TestCase;

final class AboutControllerTest extends TestCase
{
    public function testAboutControllerIsLoadableAndExposesAboutMethod(): void
    {
        $this->assertTrue(class_exists(AboutController::class));

        $controller = new AboutController();

        $this->assertInstanceOf(AboutController::class, $controller);
        $this->assertContains('about', get_class_methods($controller));
    }
}
