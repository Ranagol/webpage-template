<?php

namespace Tests\App\Controllers;

use App\Controllers\ContactController;
use PHPUnit\Framework\TestCase;

final class ContactControllerTest extends TestCase
{
    public function testContactControllerIsLoadableAndExposesContactMethod(): void
    {
        $this->assertTrue(class_exists(ContactController::class));

        $controller = new ContactController();

        $this->assertInstanceOf(ContactController::class, $controller);
        $this->assertContains('contact', get_class_methods($controller));
    }
}
