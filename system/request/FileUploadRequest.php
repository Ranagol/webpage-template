<?php

declare(strict_types=1);

namespace System\request;

/**
 * This class has the ability to actually get the uploaded file from PHP.
 *
 * When uploading a file, all the relevant data about the file upload (and the file) is
 * stored in the $_FILES. So, when we need this data in our controller,
 * we have to extract it from the $_FILES. Basically here the whole
 * upload is treated as just another post request.
 */
class FileUploadRequest extends AbstractRequest
{
    public function __construct()
    {
        $this->requestData = [
            'file' => $_FILES['file'] ?? null,
            'csrf_token' => $_POST['csrf_token'] ?? null,
        ];
    }
}
