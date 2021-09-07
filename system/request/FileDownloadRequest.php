<?php

namespace System\request;

use System\request\AbstractRequest;

class FileDownloadRequest extends AbstractRequest
{
    /**
     * Since the upload.view.php already had the needed data for the csv creating, there we just put
     * the data into the session global.Now, that we need this data, now we extract it from the
     * session.
     */
    public function __construct()
    {
        $this->requestData = $_SESSION['downloadRequest'];
    }
}
