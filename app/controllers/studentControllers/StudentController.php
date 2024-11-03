<?php

namespace App\Controllers\StudentControllers;

use App\Models\Student;
use System\response\apiResponse\studentResponse\StudentXmlResponse;
use System\response\apiResponse\studentResponse\StudentJsonResponse;

class StudentController
{
    /**
     * Show a student as an api response, either as a json or as an xml.
     * 
     * @param int $id
     * 
     * @return void
     */
    public static function show(int $id): void
    {
        $student = Student::find($id);
        
        if ($student->board === 'CSM') {
            StudentJsonResponse::send($student);
        } else {
            StudentXmlResponse::send($student);
        }
    }
}

