<?php

namespace System\request;

use System\request\AbstractRequest;

class FileUploadRequest extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = $_FILES;
    }
}
