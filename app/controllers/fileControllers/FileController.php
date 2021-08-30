<?php

namespace App\controllers\fileControllers;

use App\Models\File;
use System\request\RequestInterface;
use Exception;

class FileController
{
    /**
     * This method is called by the router, and it returns the file upload view.
     *
     * @return void
     */
    public static function displayUploadPage(): void
    {
        returnView('upload');
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
        $file = new File($uploadData);

        try {
            $file->storeFile();
            $message = 'Your upload was successfull.';
            $alertType = 'alert-success';
        } catch (Exception $error) {
            $message = $error->getMessage();
            $alertType = 'alert-warning';
        }
        
        returnView('upload', compact('message', 'alertType'));
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
