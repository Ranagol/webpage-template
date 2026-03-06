<?php

namespace Tests\App\Controllers\AuthControllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\AuthControllers\RegisterController;

final class RegisterControllerTest extends TestCase
{
    public function testRegisterControllerIsLoadableAndExposesPublicMethods(): void
    {
        $this->assertTrue(class_exists(RegisterController::class));

        $controller = new RegisterController();

        $this->assertInstanceOf(RegisterController::class, $controller);
        $this->assertTrue(method_exists($controller, 'loadRegisterPage'));
        $this->assertTrue(method_exists($controller, 'register'));
    }
}
