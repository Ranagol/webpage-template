<?php

namespace App\student;

abstract class School
{
    private string $name;
    private string $responseFormat;

    abstract public function checkIfStudentPassed(int $studentId): bool;

    abstract public function calculateAverageGrade(int $studentId): float;

}