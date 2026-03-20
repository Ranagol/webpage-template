<?php

declare(strict_types=1);

namespace Tests\App\Controllers\GuzzleControllers;

use App\Controllers\GuzzleControllers\GuzzleController;
use PHPUnit\Framework\TestCase;

final class GuzzleControllerTest extends TestCase
{
    public function testGuzzleControllerIsLoadableAndExposesPublicMethods(): void
    {
        $this->assertTrue(class_exists(GuzzleController::class));

        $controller = new GuzzleController();

        $this->assertInstanceOf(GuzzleController::class, $controller);
        $this->assertContains('loadGuzzlePage', get_class_methods($controller));
        $this->assertContains('getPosts', get_class_methods($controller));
    }
}
