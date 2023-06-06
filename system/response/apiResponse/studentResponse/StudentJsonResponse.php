<?php

namespace System\response\apiResponse\studentResponse;

use App\Models\Student;
use System\response\apiResponse\studentResponse\AbstractStudentResponse;

class StudentJsonResponse extends AbstractStudentResponse
{
    /**
     * CSM considers pass if the average is bigger or equal to 7 and fail otherwise.
     *
     * @var integer
     */
    private static int $minGradeLimit = 7;

    public static function send(Student $student, int $code = 200): void
    {
        $data = self::processStudentData($student);
        self::sendResponse($data);
    }

    private static function processStudentData(Student $student): void
    {
        //TODO I STOPPED HERE!!!!!
        //CSM considers pass if the average is bigger or equal to 7 and fail otherwise - THIS HAS TO BE INSTANTIATED HERE
    }

    private static function sendResponse($data, int $code = 200): void
    {
        $serverProtocol = $_SERVER['SERVER_PROTOCOL'];//here we create server protocoll. Example HTTP/1.1
		$statusCode = self::STATUS_CODE[$code];
        $response['status_code_header'] = $serverProtocol . ' ' . $statusCode;
        $response['body'] = json_encode($data);

        header('Content-Type: application/json');
        if ($response['body']) {
            echo $response['body'];//yup, this is the way, with echo to create a json response...
        }
    }
}
