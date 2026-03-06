<?php

namespace Tests\App\Controllers;

use App\Controllers\Controller;
use PHPUnit\Framework\TestCase;

final class ControllerBaseTest extends TestCase
{
    public function testBaseControllerIsLoadableAndExposesViewMethod(): void
    {
        $this->assertTrue(class_exists(Controller::class));

        $controller = new Controller();

        $this->assertInstanceOf(Controller::class, $controller);
        $this->assertTrue(method_exists($controller, 'view'));
    }
}
