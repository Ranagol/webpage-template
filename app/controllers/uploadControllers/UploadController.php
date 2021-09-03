<?php

namespace App\Controllers\UploadControllers;

use Exception;
use App\Models\Csv;
use App\Models\Image;
use App\Report\CsvReader\CsvReader;
use System\request\RequestInterface;
use App\Controllers\UploadControllers\UploadController;

/**
 * In this class we have a nice example how inheritance is working with static properties and 
 * methods. Also, we use here static instead of the self.
 */
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
     * models.
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public static function store(RequestInterface $request): void
    {
        $uploadData = $request->getAllRequestData();//so this is = to $_FILES now, we can treat $uploadData as the $_FILES
        //TODO LOSI: miert nagy betu, mikor en kis betuvel irtam a dir neveket? dir nevek kis betvel vagy nagy betuvel kezdodjenek?
        $modelName = 'App\Models\\' . static::getModelName();
        $file = new $modelName($uploadData);

        try {
            $file->storeFile();//TODO EZ MEG TUDJA SZEREZNI A FILE NEVET, ES EZT TOVABB KELL CSAK ADNI A 50ES VONALNAK



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
     * Also, the checking if we are working with a csv might be in a separate function only since we might need is multiple times
     *
     * @return void
     */
    public static function checkIfItIsCsv()
    {
        //TODO LOSI
        /**
         * Jelen pillanatban az app tud uploadolni image es csv. Mivel az upload 95%ba ugyanaz,
         * ezert van egy kozos parent controller. Ez. A csv uploadnal van egy extra funkcio
         * amit kell csinalni, a vegen - ezt nem kell csinalni ha image upload van. Igy oldanam meg
         * most, deeee... lehet hogy nem jo.
         * $modelName = 'App\Models\\' . static::getModelName();
         */
        // if (static::getModelName() === 'App\Models\Csv') {//TODO LOSI most akkor itt hol kell escape character es hol nem?
        if ('Csv' === 'Csv') {
            CsvReader::processCsvFile();//we need here the newly created file name, path, location!
        }
    }
}
