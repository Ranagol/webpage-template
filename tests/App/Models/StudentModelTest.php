<?php

declare(strict_types=1);

namespace Tests\App\Models;

use App\Models\Student;
use PHPUnit\Framework\TestCase;

final class StudentModelTest extends TestCase
{
    public function testAverageGradeCalculation(): void
    {
        $student = new Student();
        $student->grades = [6, 8, 10];

        $this->assertSame(8.0, $student->calculcateAverageGrade());
    }

    public function testAverageGradeReturnsZeroWhenNoGrades(): void
    {
        $student = new Student();
        $student->grades = [];

        $this->assertSame(0.0, $student->calculcateAverageGrade());
    }
}
