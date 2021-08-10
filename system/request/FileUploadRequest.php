<?php

namespace System\request;

use System\request\AbstractRequest;

/**
 * When uploadin a file, all the relevant data about the file upload is 
 * stored in the $_FILES. So, when we need this data in our controller, 
 * we have to extract it from the $_FILES. Basically here the whole 
 * upload is treated as just another post request.
 */
class FileUploadRequest extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = $_FILES;
    }
}
