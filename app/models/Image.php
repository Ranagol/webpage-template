<?php

namespace App\Models;

use App\Models\AbstractUploadModel;

/**
 * The File model handles the file uploading.
 */
class Image extends AbstractUploadModel
{
    /**
     * All the allowed upload formats are stored here.
     *
     * @var array
     */
    protected $allowedFileFormats = [
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/png',
    ];

    
}
