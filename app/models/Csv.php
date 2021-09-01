<?php

namespace App\models;

use App\Models\AbstractUploadModel;

class Csv extends AbstractUploadModel
{
    protected $guarded = [];

    /**
     * All the allowed upload formats are stored here.
     *
     * @var array
     */
    protected $allowedFileFormats = ['application/vnd.ms-excel'];

    /**
     * In some cases, the uploaded file needs to be read, changed (processed),
     * and in these cases we call this method.
     *
     * @return void
     */
    public static function processCsvFile(): void
    {
        
    }

}