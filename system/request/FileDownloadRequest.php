<?php

namespace System\request;

use System\request\AbstractRequest;

class FileDownloadRequest extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = $_SESSION['downloadRequest'];
    }
}
