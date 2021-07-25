<?php

namespace app\system\response;

class ApiResponse
{
	/**
	 * Notice that this is a constant!
	 * This data will be used to create a response status code with a message.
	 */
    private const STATUS_CODE = [
		100 => "100 Continue",
		101 => "101 Switching Protocols",
		200 => "200 OK",
		201 => "201 Created",
		202 => "202 Accepted",
		203 => "203 Non-Authoritative Information",
		204 => "204 No Content",
		205 => "205 Reset Content",
		206 => "206 Partial Content",
		300 => "300 Multiple Choices",
		301 => "301 Moved Permanently",
		302 => "302 Found",
		303 => "303 See Other",
		304 => "304 Not Modified",
		305 => "305 Use Proxy",
		307 => "307 Temporary Redirect",
		400 => "400 Bad Request",
		401 => "401 Unauthorized",
		402 => "402 Payment Required",
		403 => "403 Forbidden",
		404 => "404 Not Found",
		405 => "405 Method Not Allowed",
		406 => "406 Not Acceptable",
		407 => "407 Proxy Authentication Required",
		408 => "408 Request Time-out",
		409 => "409 Conflict",
		410 => "410 Gone",
		411 => "411 Length Required",
		412 => "412 Precondition Failed",
		413 => "413 Request Entity Too Large",
		414 => "414 Request-URI Too Large",
		415 => "415 Unsupported Media Type",
		416 => "416 Requested range not satisfiable",
		417 => "417 Expectation Failed",
		422 => "422 Unprocessable Entity",
		500 => "500 Internal Server Error",
		501 => "501 Not Implemented",
		502 => "502 Bad Gateway",
		503 => "503 Service Unavailable",
		504 => "504 Gateway Time-out"
	];

	/**
     * When we want to create a json response in our vanilla api, we
     * must do three things.
     * 1. the needed data has to be transformed into json, with json_encode
     * 2. we must tell php the handle our response as a json. We do this by setting the header like
     * header("Content-Type: application/json");
	 * 3. We must set a response status header, which should contain the 
	 * server protocol and the response status code.
     *
     */
    public static function send($data, int $code = 200)
    {
		$serverProtocol = $_SERVER['SERVER_PROTOCOL'];//example HTTP/1.1
		$statusCode = self::STATUS_CODE[$code];
        $response['status_code_header'] = $serverProtocol . ' ' . $statusCode;
        $response['body'] = json_encode($data);

        header('Content-Type: application/json');
        if ($response['body']) {
            echo $response['body'];
        }
    }

}
