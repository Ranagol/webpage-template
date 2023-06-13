<?php

namespace System\request;

use System\request\AbstractRequest;

class ApiRequest extends AbstractRequest
{
    /**
     * When working with api request, there are two ways of getting the data from the
     * request. 
     * 1-get from the url (delete, show, index...)
     * 2-get from the request body (create, update/put... so: POST like requests, with data in the r. body)
     * This 2. is being done in this function/class.
     * 
     * Basically, we use this class to get the data from the request body.
     * 
     * For GET, DELETE, SHOW we do not use this ApiRequest class, we trigger the UserApiController
     * immediatelly.
     * 
     * And this is how to receive JSON POST date from the request with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     * So. The request arrives. When we create a ApiRequest object, we 
     * store the request data in the the ApiRequest object. This object will be 
     * used in the controller.
     * Also, check the parent class, because this class by itself is incomplete for 
     * understanding.
     */
    public function __construct()
    {
        /**
         * And this is how to receive JSON POST with PHP. This is where the magic happens.
         */
        $rawJsonData = file_get_contents('php://input');

        /**
         * this line is needed here, because during the data extraction above, there will be an 
         * strange not-really-json format (so json_decode will not work!), and with this line we 
         * make the data to be json format. Basically we transform the data here.
         */
        $rawJsonData = str_replace([PHP_EOL, ",}"], ["", "}"], $rawJsonData);

        /**
         * this will be an array. $this->requestData is not in this class, it is inherited from the 
         * parent class.
         */
        $this->requestData = json_decode($rawJsonData, true);
    }
}
