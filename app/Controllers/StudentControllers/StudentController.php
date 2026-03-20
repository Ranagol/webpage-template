<?php

namespace App\Controllers\StudentControllers;

use App\Models\Student;
use System\response\apiResponse\studentResponse\StudentJsonResponse;
use System\response\apiResponse\studentResponse\StudentXmlResponse;

class StudentController
{
    /**
     * Show a student as an api response, either as a json or as an xml.
     */
    public static function show(int $id): void
    {
        $student = Student::find($id);

        if ('CSM' === $student->board) {
            StudentJsonResponse::send($student);
        } else {
            StudentXmlResponse::send($student);
        }
    }
}
