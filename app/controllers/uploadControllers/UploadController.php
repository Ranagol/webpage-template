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
     * We use the FileUploadRequest to get the uploaded file, and this actually happens in
     * routesUpload.php
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public static function store(RequestInterface $request): void
    {
        
        /**
         * Here we extract the upload data and the upload file.
         * So this below is = to $_FILES now, we can treat $uploadData as the $_FILES
         */
        $uploadData = $request->getAllRequestData();

        /**
         * The Upload model has all the logic to handle the upload process.
         */
        $upload = new Upload($uploadData);

        $t = 8;

        try {
            $file = $upload->storeFile();

            /**
             * Now, here we have two cases. If the uploaded file is an image, then nothing should
             * be returned to the upload page. But, if the uploaded file is a .csv file, then a 
             * specific report should be returned to the user, that will be downloadable.
             * 
             * If the uploaded file is a .csv file, then the created CsvFile object (that will 
             * contain the .csv file) will have implemented a Reportable interface.
             */
            if ($file instanceof Reportable) {
                $t = 8;
                $report = $file->getReport();

            } else {
                $t = 8;
                $report = null;
            }
            
            /**
             * Feedback message for the user, display in the upload view.
             */
            $message = 'Your upload was successfull.';
            $alertType = 'alert-success';

        } catch (Exception $error) {

            $message = $error->getMessage();
            $alertType = 'alert-warning';
        }
        
        returnView('upload', compact('message', 'alertType', 'report'));
    }
}
