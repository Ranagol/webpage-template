<?php

namespace app\System;

use app\System\AbstractRequest;

class JsonRequest extends AbstractRequest
{
    /**
     * When working with api request, there are two ways of getting the data from the
     * request. 
     * 1-get from the url (delete, show, index...)
     * 2-get from the request body (create, update...)
     * This 2. is being done in this function.
     * And this is how to receive JSON POST with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     * So. The request arrives. When we create a JsonRequest object, we 
     * store the request data in the the JsonRequest object. This object will be 
     * used in the controller.
     * Also, check the parent class, because this class by itself is incomplete for 
     * understanding.
     *
     * @return void
     */
    public function __construct()
    {
        $rawJsonData = file_get_contents('php://input');
        $rawJsonData = str_replace([PHP_EOL, ",}"], ["", "}"], $rawJsonData);
        $this->requestData = json_decode($rawJsonData, true);//this will be an array
    }
}
