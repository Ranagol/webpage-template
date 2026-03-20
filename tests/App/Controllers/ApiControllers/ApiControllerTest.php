<?php

declare(strict_types=1);

namespace Tests\App\Controllers\ApiControllers;

use App\Controllers\ApiControllers\ApiController;
use PHPUnit\Framework\TestCase;

final class ApiControllerTest extends TestCase
{
    public function testApiControllerIsLoadable(): void
    {
        $this->assertTrue(class_exists(ApiController::class));

        $controller = new ApiController();

        $this->assertInstanceOf(ApiController::class, $controller);
    }
}
