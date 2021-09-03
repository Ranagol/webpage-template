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

}