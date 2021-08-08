<?php

namespace App\controllers\fileControllers;

use App\Models\File;
use System\request\RequestInterface;

class FileController
{
    /**
     * This method is called by the router, and it returns the file upload view.
     *
     * @return void
     */
    public static function displayUploadPage()
    {
        return view('upload');
    }

    /**
     * Handles the file upload.
     *
     * @param RequestInterface $request
     * @return void
     */
    public static function store(RequestInterface $request)
    {
        $uploadData = $request->getAllRequestData();//so this is = to $_FILES now, we can treat $uploadData as the $_FILES
        $file = new File($uploadData);
        $errorMessage = $file->storeFile();
        
        if ($errorMessage) {
            return view('upload', compact('errorMessage'));
        }

        return view('upload');
    }

    /**
     * In some cases, the uploaded file needs to be read, changed (processed),
     * and in these cases we call this method.
     *
     * @return void
     */
    public static function processFile()
    {

    }
}
