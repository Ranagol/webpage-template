<?php

namespace Tests\App\Student;

use App\Models\Student;
use App\Student\SchoolCSM;
use PHPUnit\Framework\TestCase;

final class SchoolCSMTest extends TestCase
{
    public function testCsmAverageAndPassRule(): void
    {
        $student = new Student();
        $student->grades = [8, 7, 9];

        $school = new SchoolCSM();

        $this->assertSame(8.0, $school->calculateAverageGrade($student));
        $this->assertSame('Pass', $school->checkIfStudentPassed($student));
    }
}
