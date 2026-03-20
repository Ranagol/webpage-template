<?php

declare(strict_types=1);

namespace Tests\App\Controllers\AuthControllers;

use App\Controllers\AuthControllers\RegisterController;
use PHPUnit\Framework\TestCase;

final class RegisterControllerTest extends TestCase
{
    public function testRegisterControllerIsLoadableAndExposesPublicMethods(): void
    {
        $this->assertTrue(class_exists(RegisterController::class));

        $controller = new RegisterController();

        $this->assertInstanceOf(RegisterController::class, $controller);
        $this->assertContains('loadRegisterPage', get_class_methods($controller));
        $this->assertContains('register', get_class_methods($controller));
    }
}
