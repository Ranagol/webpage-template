<?php

namespace System\request;

use System\request\AbstractRequest;

/**
 * This class gets the request data sent from the webpage (and not api).
 * The request data (for example, a user registration data) will be collected from the $_REQUEST
 * superglobal, and placed into the $this->requestData.
 * $this->requestData is a property inherited from the parent class.
 */
class WebPageRequest extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = $_REQUEST;
    }
}
