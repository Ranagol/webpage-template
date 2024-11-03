<?php

namespace System\response\apiResponse\studentResponse;

use App\Models\Student;
use System\response\apiResponse\studentResponse\AbstractStudentResponse;
use App\student\SchoolCSMB;

class StudentXmlResponse extends AbstractStudentResponse
{
    public static function send(Student $student, int $code = 200): void
    {
        $studentArray = self::evaluateStudent($student);
        self::sendResponse($studentArray, $code);
    }

    private static function evaluateStudent(Student $student): array
    {
        $schoolCSMB = new SchoolCSMB();
        $studentArray = $student->toArray();
        $studentArray['average'] = $schoolCSMB->calculateAverageGrade($student);
        $studentArray['passed'] = $schoolCSMB->checkIfStudentPassed($student);

        $t = 8;

        return $studentArray;
    }

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
                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }

        $t = 8;

        return $xmlData->asXML();
    }
}
