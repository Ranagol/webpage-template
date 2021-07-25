<?php

namespace app\System\request;

use app\system\request\AbstractRequest;

/**
 * This class gets the request data sent from the webpage (and not api).
 */
class WebPageRequest extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = $_REQUEST;
    }
}
