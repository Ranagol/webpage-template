<?php

namespace Tests\App\Student;

use App\Student\School;
use PHPUnit\Framework\TestCase;

final class SchoolTest extends TestCase
{
    public function testSchoolIsAbstractBaseClass(): void
    {
        $reflection = new \ReflectionClass(School::class);

        $this->assertTrue($reflection->isAbstract());
        $this->assertTrue($reflection->hasMethod('checkIfStudentPassed'));
        $this->assertTrue($reflection->hasMethod('calculateAverageGrade'));
    }
}
