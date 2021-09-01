<?php

namespace App\Controllers\UploadControllers;

use App\Controllers\UploadControllers\UploadController;
use Exception;
use App\Models\Csv;

class CsvUploadController extends UploadController
{
    public static function displayUploadPage(): void
    {

    }

    public static function store(): void
    {

    }

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
