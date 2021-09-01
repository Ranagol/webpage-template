<?php

namespace App\controllers\uploadControllers;

use Exception;
use App\Models\Image;
use System\request\RequestInterface;
use App\Controllers\UploadControllers\UploadController;

class ImageUploadController extends UploadController
{
    protected static $pageName = 'upload-image';

    // protected static $modelName = 'app\models\Image';

    protected static $modelName = 'Image';

    
}
