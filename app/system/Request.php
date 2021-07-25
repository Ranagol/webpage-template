<?php

namespace app\System;

/**
 * This class gets the request data sent from the webpage (and not api).
 */
class Request extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = $_REQUEST;
    }
}
