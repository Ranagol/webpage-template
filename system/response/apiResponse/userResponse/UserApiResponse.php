<?php

namespace System\response\apiResponse\userResponse;

use System\response\apiResponse\AbstractApiResponse;

class UserApiResponse extends AbstractApiResponse
{
    /**
     * When we want to create a json response in our vanilla api, we
     * must do three things.
     * 1. the needed data has to be transformed into json, with json_encode
     * 2. we must tell php the handle our response as a json. We do this by setting the header like
     * header("Content-Type: application/json");
	 * 3. We must set a response status header, which should contain the 
	 * server protocol and the response status code.
	 * 
	 * @return void
     *
     */
    public static function send($data, int $code = 200): void
    {
		$serverProtocol = $_SERVER['SERVER_PROTOCOL'];//here we create server protocoll. Example HTTP/1.1
		$statusCode = self::STATUS_CODE[$code];//STATUS_CODE is a constant property inherited from the parent class
        $response['status_code_header'] = $serverProtocol . ' ' . $statusCode;
        $response['body'] = json_encode($data);

        header('Content-Type: application/json');
        if ($response['body']) {
            echo $response['body'];//yup, this is the way, with echo to create a json response...
        }
    }
}
