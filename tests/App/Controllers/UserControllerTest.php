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
        $this->assertContains('index', get_class_methods($controller));
        $this->assertContains('show', get_class_methods($controller));
        $this->assertContains('create', get_class_methods($controller));
        $this->assertContains('store', get_class_methods($controller));
        $this->assertContains('update', get_class_methods($controller));
        $this->assertContains('delete', get_class_methods($controller));
    }
}
