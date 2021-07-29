<?php

namespace App\controllers\fileControllers;

use System\request\RequestInterface;

class FileController
{

    public static function displayUploadPage()
    {
        return view('upload');
    }

    public static function store(RequestInterface $request)
    {
        $uploadData = $request->getAllRequestData();//so this is = to $_FILES now
        $file = new File($uploadData);
        $file->storeFile();

        
    }

    public static function procesFile()
    {

    }
}
