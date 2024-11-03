<?php

namespace App\student;

use App\models\Student;

class SchoolCSM extends School
{
    /**
     * Check if student passed, according the CSM rules.
     * 
     * @param Student $student
     * 
     * @return bool
     */
    public function checkIfStudentPassed(Student $student): bool
    {
        $averageGrade = $student->calculcateAverageGrade();

        if ($averageGrade >= 7) {
            return true;
        } 
        
        return false;
    }

    /**
     * Calculate the average grade of a student.
     * 
     * @param Student $student
     * 
     * @return float
     */
    public function calculateAverageGrade(Student $student): float
    {
        $averageGrade = $student->calculcateAverageGrade();
        
        return $averageGrade;
    }
}