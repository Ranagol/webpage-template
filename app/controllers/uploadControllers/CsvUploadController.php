<?php

namespace App\Controllers\UploadControllers;

use App\Controllers\UploadControllers\UploadController;
use Exception;
use App\Models\Csv;

class CsvUploadController extends UploadController
{
    protected static $pageName = 'upload-csv';

    protected static $modelName = 'Csv';

    /**
     * In some cases, the uploaded file needs to be read, changed (processed),
     * and in these cases we call this method.
     *
     * @return void
     */
    public static function processFile(): void
    {
        //process the file
    }

}
