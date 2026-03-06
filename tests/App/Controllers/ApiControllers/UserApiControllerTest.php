<?php

namespace Tests\App\Controllers\ApiControllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\ApiControllers\UserApiController;

final class UserApiControllerTest extends TestCase
{
    public function testUserApiControllerIsLoadableAndExposesCrudMethods(): void
    {
        $this->assertTrue(class_exists(UserApiController::class));
        $this->assertTrue(method_exists(UserApiController::class, 'index'));
        $this->assertTrue(method_exists(UserApiController::class, 'show'));
        $this->assertTrue(method_exists(UserApiController::class, 'store'));
        $this->assertTrue(method_exists(UserApiController::class, 'update'));
        $this->assertTrue(method_exists(UserApiController::class, 'delete'));
    }
}
