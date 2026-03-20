<?php

namespace Tests\App\Controllers\ApiControllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\ApiControllers\UserApiController;

final class UserApiControllerTest extends TestCase
{
    public function testUserApiControllerIsLoadableAndExposesCrudMethods(): void
    {
        $this->assertTrue(class_exists(UserApiController::class));

        $methods = get_class_methods(UserApiController::class);

        $this->assertContains('index', $methods);
        $this->assertContains('show', $methods);
        $this->assertContains('store', $methods);
        $this->assertContains('update', $methods);
        $this->assertContains('delete', $methods);
    }
}
