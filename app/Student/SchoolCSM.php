<?php

declare(strict_types=1);

namespace App\Student;

use App\Models\Student;

class SchoolCSM extends School
{
    /**
     * Check if student passed, according the CSM rules.
     */
    public function checkIfStudentPassed(Student $student): string
    {
        $averageGrade = $student->calculcateAverageGrade();

        if ($averageGrade >= 7) {
            return 'Pass';
        }

        return 'Fail';
    }

    /**
     * Calculate the average grade of a student.
     */
    public function calculateAverageGrade(Student $student): float
    {
        $averageGrade = $student->calculcateAverageGrade();

        return $averageGrade;
    }
}
