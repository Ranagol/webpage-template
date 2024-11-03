<?php

namespace System\response\apiResponse\studentResponse;

use App\Models\Student;
use System\response\apiResponse\studentResponse\AbstractStudentResponse;
use App\student\SchoolCSM;

/**
 * When we student is from CSM school, we send a json response. This json response is created in this
 * class.
 */
class StudentJsonResponse extends AbstractStudentResponse
{
    /**
     * Send a json response.
     * 
     * @param Student $student
     * @param int $code
     * 
     * @return void
     */
    public static function send(Student $student, int $code = 200): void
    {
        $studentArray = self::evaluateStudent($student);
        self::sendResponse($studentArray, $code);
    }

    /**
     * This is the place where we calculate the average grade and check if the student passed, 
     * according to the CSM rules.
     *
     * @param Student $student
     * @return array
     */
    private static function evaluateStudent(Student $student): array
    {
        $schoolCSM = new SchoolCSM();
        $studentArray = $student->toArray();
        $studentArray['average'] = $schoolCSM->calculateAverageGrade($student);
        $studentArray['passed'] = $schoolCSM->checkIfStudentPassed($student);

        return $studentArray;
    }

    /**
     * Send a json response.
     * 
     * @param Student $student
     * @param int $code
     * 
     * @return void
     */
    private static function sendResponse($data, int $code = 200): void
    {
        $serverProtocol = $_SERVER['SERVER_PROTOCOL'];//here we create server protocoll. Example HTTP/1.1
		$statusCode = self::STATUS_CODE[$code];
        $response['status_code_header'] = $serverProtocol . ' ' . $statusCode;
        $response['body'] = json_encode($data);

        /**
         * This is the way to send a json response in vanilla php.
         */
        header('Content-Type: application/json');
        if ($response['body']) {
            echo $response['body'];
        }
    }
}
