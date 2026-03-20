<?php

declare(strict_types=1);

namespace Tests\App\Controllers\StudentControllers;

use App\Controllers\StudentControllers\StudentController;
use PHPUnit\Framework\TestCase;

final class StudentControllerTest extends TestCase
{
    public function testStudentControllerIsLoadableAndExposesShowMethod(): void
    {
        $this->assertTrue(class_exists(StudentController::class));
        $this->assertContains('show', get_class_methods(StudentController::class));
    }
}
