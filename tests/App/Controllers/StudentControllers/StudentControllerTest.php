<?php

namespace Tests\App\Controllers\StudentControllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\StudentControllers\StudentController;

final class StudentControllerTest extends TestCase
{
    public function testStudentControllerIsLoadableAndExposesShowMethod(): void
    {
        $this->assertTrue(class_exists(StudentController::class));
        $this->assertTrue(method_exists(StudentController::class, 'show'));
    }
}
