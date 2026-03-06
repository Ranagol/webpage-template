<?php

namespace Tests\App\Controllers\AuthControllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\AuthControllers\LoginController;

final class LoginControllerTest extends TestCase
{
    public function testLoginControllerIsLoadableAndExposesPublicMethods(): void
    {
        $this->assertTrue(class_exists(LoginController::class));

        $controller = new LoginController();

        $this->assertInstanceOf(LoginController::class, $controller);
        $this->assertTrue(method_exists($controller, 'loadLoginPage'));
        $this->assertTrue(method_exists($controller, 'login'));
        $this->assertTrue(method_exists($controller, 'logout'));
    }
}
