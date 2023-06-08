<?php

namespace App\Controllers\UploadControllers;

use Exception;
use App\Models\Upload;
use System\request\RequestInterface;
use App\Report\ReportDomain\Reportable;

/**
 * In this class we have a nice example how inheritance is working with static properties and 
 * methods. 
 * 
 * All the heavy work is done by the Upload model.
 * 
 * Also, we use here static instead of the self.
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

        $t = 8;

        try {
            $file = $upload->storeFile();

            if ($file instanceof Reportable) {
                $t = 8;
                $report = $file->getReport();

            } else {
                $t = 8;
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
