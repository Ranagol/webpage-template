<?php

namespace App\student;

use App\Models\Student;
abstract class School
{
    /**
     * @param Student $student
     * 
     * @return bool
     */
    abstract public function checkIfStudentPassed(Student $student): bool;

    /**
     * @param Student $student
     * 
     * @return float
     */
    abstract public function calculateAverageGrade(Student $student): float;
}