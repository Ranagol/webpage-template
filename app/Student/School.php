<?php

namespace App\Student;

use App\Models\Student;

abstract class School
{
    abstract public function checkIfStudentPassed(Student $student): string;

    abstract public function calculateAverageGrade(Student $student): float;
}
