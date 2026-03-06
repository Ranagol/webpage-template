<?php

namespace Tests\App\Controllers;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;

final class UserControllerTest extends TestCase
{
    public function testUserControllerIsLoadableAndExposesCrudMethods(): void
    {
        $this->assertTrue(class_exists(UserController::class));

        $controller = new UserController();

        $this->assertInstanceOf(UserController::class, $controller);
        $this->assertTrue(method_exists($controller, 'index'));
        $this->assertTrue(method_exists($controller, 'show'));
        $this->assertTrue(method_exists($controller, 'create'));
        $this->assertTrue(method_exists($controller, 'store'));
        $this->assertTrue(method_exists($controller, 'update'));
        $this->assertTrue(method_exists($controller, 'delete'));
    }
}
