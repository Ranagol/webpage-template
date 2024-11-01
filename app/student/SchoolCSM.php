<?php

namespace App\student;

use App\models\Student;

class SchoolCSM extends School
{
    private string $name = 'SchoolCSM';
    private string $responseFormat = 'json';

    public function checkIfStudentPassed(int $studentId): bool
    {
        $student = Student::find($studentId);
        $averageGrade = $student->calculcateAverageGrade();

        if ($averageGrade >= 7) {
            return true;
        } 
        
        return false;
    }

    public function calculateAverageGrade(int $studentId): float
    {
        $student = Student::find($studentId);
        $averageGrade = $student->calculcateAverageGrade();
        return $averageGrade;
    }


}