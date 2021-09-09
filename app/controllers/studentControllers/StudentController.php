<?php

namespace App\Controllers\StudentControllers;

use App\Models\Student;

class StudentController
{
    public static function show(int $id)
    {
        $student = Student::find($id);
        
        $t = 8;


        // $serverProtocol = $_SERVER['SERVER_PROTOCOL'];//here we create server protocoll. Example HTTP/1.1
		// $statusCode = 200;
        // $response['status_code_header'] = $serverProtocol . ' ' . $statusCode;
        // $response['body'] = json_encode('All is ok');

        // header('Content-Type: application/json');
        // if ($response['body']) {
        //     echo $response['body'];//yup, this is the way, with echo to create a json response...
        // }
    }
}
