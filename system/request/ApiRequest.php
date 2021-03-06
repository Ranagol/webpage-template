<?php

namespace System\request;

use System\request\AbstractRequest;

class ApiRequest extends AbstractRequest
{
    /**
     * When working with api request, there are two ways of getting the data from the
     * request. 
     * 1-get from the url (delete, show, index...)
     * 2-get from the request body (create, update...)
     * This 2. is being done in this function.
     * And this is how to receive JSON POST with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     * So. The request arrives. When we create a ApiRequest object, we 
     * store the request data in the the ApiRequest object. This object will be 
     * used in the controller.
     * Also, check the parent class, because this class by itself is incomplete for 
     * understanding.
     */
    public function __construct()
    {
        $rawJsonData = file_get_contents('php://input');//And this is how to receive JSON POST with PHP:
        $rawJsonData = str_replace([PHP_EOL, ",}"], ["", "}"], $rawJsonData);//this line is needed here, because during the data extraction above, there will be an strange not-really-json format (so json_decode will not work!), and with this line we make the data to be json format.
        $this->requestData = json_decode($rawJsonData, true);//this will be an array
    }
}
