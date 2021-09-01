<?php

namespace App\controllers\uploadControllers;

use Exception;
use App\Models\Image;
use System\request\RequestInterface;
use App\Controllers\UploadControllers\UploadController;

class ImageUploadController extends UploadController
{
    /**
     * This method is called by the router, and it returns the file upload view.
     *
     * @return void
     */
    public static function displayUploadPage(): void
    {
        returnView('upload-image');
    }

    /**
     * Handles the file upload. Since this class is a controller
     * and we want slim controllers, all the upload work is done by the 
     * File model.
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public static function store(RequestInterface $request): void
    {
        $uploadData = $request->getAllRequestData();//so this is = to $_FILES now, we can treat $uploadData as the $_FILES
        $file = new Image($uploadData);

        try {
            $file->storeFile();
            $message = 'Your upload was successfull.';
            $alertType = 'alert-success';
        } catch (Exception $error) {
            $message = $error->getMessage();
            $alertType = 'alert-warning';
        }
        
        returnView('upload-image', compact('message', 'alertType'));
    }

    
}
