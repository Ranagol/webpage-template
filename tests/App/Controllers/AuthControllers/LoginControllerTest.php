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
        $this->assertContains('loadLoginPage', get_class_methods($controller));
        $this->assertContains('login', get_class_methods($controller));
        $this->assertContains('logout', get_class_methods($controller));
    }
}
