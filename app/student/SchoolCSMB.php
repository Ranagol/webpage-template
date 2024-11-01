<?php

namespace App\student;

use App\models\Student;

class SchoolCSM extends School
{
    private string $name = 'SchoolCSM';
    private string $responseFormat = 'xml';

    public function checkIfStudentPassed(int $studentId): bool
    {
        $student = Student::find($studentId);
        $allGrades = $student->grades;
        $biggestGrade = max($allGrades);

        if ($biggestGrade > 8) {
            return true;
        }

        return false;
    }

    public function calculateAverageGrade(int $studentId): float
    {
        $student = Student::find($studentId);
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