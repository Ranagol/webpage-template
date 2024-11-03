<?php

namespace System\response\apiResponse\studentResponse;

use App\Models\Student;
use System\response\apiResponse\studentResponse\AbstractStudentResponse;
use App\student\SchoolCSMB;

/**
 * When we student is from CSMB school, we send a xml response. This xml response is created in this
 * class.
 */
class StudentXmlResponse extends AbstractStudentResponse
{
    /**
     * Send a xml response.
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
     * according to the CSMB rules.
     *
     * @param Student $student
     * @return array
     */
    private static function evaluateStudent(Student $student): array
    {
        $schoolCSMB = new SchoolCSMB();
        $studentArray = $student->toArray();
        $studentArray['average'] = $schoolCSMB->calculateAverageGrade($student);
        $studentArray['passed'] = $schoolCSMB->checkIfStudentPassed($student);

        return $studentArray;
    }

    /**
     * Send a xml response.
     * 
     * @param Student $student
     * @param int $code
     * 
     * @return void
     */
    private static function sendResponse($data, int $code = 200): void
    {
        $serverProtocol = $_SERVER['SERVER_PROTOCOL'];
        $statusCode = self::STATUS_CODE[$code];
        $response['status_code_header'] = $serverProtocol . ' ' . $statusCode;
        $response['body'] = self::arrayToXml($data);

        header($response['status_code_header']);
        header('Content-Type: application/xml');
        echo $response['body'];
    }

    /**
     * Convert a php array to xml.
     * 
     * @param array $data
     * @param \SimpleXMLElement $xmlData
     * 
     * @return string
     */
    private static function arrayToXml(array $data, \SimpleXMLElement $xmlData = null): string
    {
        if ($xmlData === null) {
            $xmlData = new \SimpleXMLElement('<?xml version="1.0"?><student></student>');
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $subnode = $xmlData->addChild($key);
                self::arrayToXml($value, $subnode);
            } else {

                /**
                 * XML works with strings, can't have boolean values. So we convert them to strings.
                 */
                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }

        return $xmlData->asXML();
    }
}
