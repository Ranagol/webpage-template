<?php

declare(strict_types=1);

namespace App\Student;

use App\Models\Student;

abstract class School
{
    abstract public function checkIfStudentPassed(Student $student): string;

    abstract public function calculateAverageGrade(Student $student): float;
}
