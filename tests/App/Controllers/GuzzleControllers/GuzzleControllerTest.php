<?php

namespace Tests\App\Controllers\GuzzleControllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\GuzzleControllers\GuzzleController;

final class GuzzleControllerTest extends TestCase
{
    public function testGuzzleControllerIsLoadableAndExposesPublicMethods(): void
    {
        $this->assertTrue(class_exists(GuzzleController::class));

        $controller = new GuzzleController();

        $this->assertInstanceOf(GuzzleController::class, $controller);
        $this->assertTrue(method_exists($controller, 'loadGuzzlePage'));
        $this->assertTrue(method_exists($controller, 'getPosts'));
    }
}
