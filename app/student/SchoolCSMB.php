<?php

namespace App\student;

use App\models\Student;

class SchoolCSMB extends School
{
    /**
     * Check if student passed by CSMB rules.
     * 
     * @param Student $student
     * 
     * @return bool
     */
    public function checkIfStudentPassed(Student $student): string
    {
        $allGrades = $student->grades;
        $biggestGrade = max($allGrades);

        if ($biggestGrade > 8) {
            return 'Pass';
        }

        return 'Fail';
    }

    /**
     * Calculate average grade by CSMB rules.
     * 
     * @param Student $student
     * 
     * @return float
     */
    public function calculateAverageGrade(Student $student): float
    {
        $allGrades = $student->grades;
        $numberOfGrades = count($allGrades);

        if ($numberOfGrades > 2) {
            $lowestGrade = min($allGrades);
            //Remove the lowest grade from grades array
            $modifiedGrades = array_diff($allGrades, [$lowestGrade]);
            $sum = array_sum($modifiedGrades);
            $count = count($modifiedGrades);
            $averageGrade = $sum / $count;

            return $averageGrade;
        } else {
            $averageGrade = $student->calculcateAverageGrade();

            return $averageGrade;
        }
    }
}