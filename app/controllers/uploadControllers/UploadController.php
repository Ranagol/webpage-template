<?php

namespace App\Controllers\UploadControllers;

use Exception;
use System\request\RequestInterface;
use App\models\Image;
use App\Models\Csv;
use App\Controllers\UploadControllers\UploadController;

class UploadController
{
    protected static $pageName;
    protected static $modelName;

    /**
     * This method is called by the router, and it returns the file upload view.
     *
     * @return void
     */
    public static function displayUploadPage(): void
    {
        returnView(static::getPageName());
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
        $modelName = static::getModelName();
        //TODO LOSI Image/Csv hardcoded, szeretnem a $modelName-t betenni ide, nem ertem miert nem mukodik
        $file = new Csv($uploadData);

        try {
            $file->storeFile();
            $message = 'Your upload was successfull.';
            $alertType = 'alert-success';
            static::checkIfItIsCsv();
        } catch (Exception $error) {
            $message = $error->getMessage();
            $alertType = 'alert-warning';
        }
        
        returnView(static::getPageName(), compact('message', 'alertType'));
    }

    public static function getModelName(): string
    {
        return static::$modelName;
    }

    public static function getPageName(): string
    {
        return static::$pageName;
    }

    /**
     * This is an unfinished, hardcoded method!!!!!!!!!!!!!!!!!!!!!!!!!!
     * Once consulted with Losi, this has to be corrected.
     * 
     *
     * @return void
     */
    public static function checkIfItIsCsv()
    {
        //TODO LOSI
        // if (static::getModelName() === 'Csv') {
        if ('Csv' === 'Csv') {
            Csv::processCsvFile();
        }
    }
}
