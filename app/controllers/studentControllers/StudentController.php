<?php

namespace App\Controllers\StudentControllers;

use App\Models\Student;
use System\response\apiResponse\studentResponse\StudentXmlResponse;
use System\response\apiResponse\studentResponse\StudentJsonResponse;

class StudentController
{
    public static function show(int $id)
    {
        // die('Student die triggered');

        $student = Student::find($id);

        var_dump($student);
        
        if ($student->board === 'CSM') {
            StudentJsonResponse::send($student);
        } else {
            StudentXmlResponse::send($student);
        }
        
        
    }
}

