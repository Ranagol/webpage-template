<?php

namespace Tests\App\Student;

use App\Models\Student;
use App\Student\SchoolCSMB;
use PHPUnit\Framework\TestCase;

final class SchoolCSMBTest extends TestCase
{
    public function testCsmbPassFailAndAverageRules(): void
    {
        $passingStudent = new Student();
        $passingStudent->grades = [8, 9, 7];

        $failingStudent = new Student();
        $failingStudent->grades = [4, 5, 6];

        $school = new SchoolCSMB();

        $this->assertSame('Pass', $school->checkIfStudentPassed($passingStudent));
        $this->assertSame('Fail', $school->checkIfStudentPassed($failingStudent));
        $this->assertSame(8.5, $school->calculateAverageGrade($passingStudent));
    }
}
