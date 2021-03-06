<?php

namespace App\Controllers\UploadControllers;

use Exception;
use App\Models\Upload;
use App\Report\CsvReader\CsvReader;
use System\request\RequestInterface;
use App\Controllers\UploadControllers\UploadController;
use App\Report\ReportDomain\Reportable;

/**
 * In this class we have a nice example how inheritance is working with static properties and 
 * methods. Also, we use here static instead of the self.
 */
class UploadController
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
     * models.
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public static function store(RequestInterface $request): void
    {
        //so this below is = to $_FILES now, we can treat $uploadData as the $_FILES
        $uploadData = $request->getAllRequestData();
        $upload = new Upload($uploadData);

        try {
            $file = $upload->storeFile();
            if ($file instanceof Reportable) {
                $report = $file->getReport();
            } else {
                $report = null;
            }
            
            $message = 'Your upload was successfull.';
            $alertType = 'alert-success';
        } catch (Exception $error) {
            $message = $error->getMessage();
            $alertType = 'alert-warning';
        }
        
        returnView('upload', compact('message', 'alertType', 'report'));
    }
}
