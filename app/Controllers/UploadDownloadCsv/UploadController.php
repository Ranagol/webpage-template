<?php

namespace App\Controllers\UploadDownloadCsv;

use App\controllers\Controller;
use Exception;
use App\Models\Upload;
use System\request\RequestInterface;
use App\Report\ReportDomain\Reportable;

/**
 * All the heavy work is done by the Upload model.
 */
class UploadController extends Controller
{

    /**
     * Returns the file upload view.
     *
     * @return void
     */
    public function displayUploadPage(): void
    {
        $this->view('upload');
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
    public function store(RequestInterface $request): void
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
                $report = $file->getReport();
            } else {
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
            $report = null;
        }
        
        $this->view(
            'upload',
            [
                'message' => $message,
                'alertType' => $alertType,
                'report' => $report
            ]
        );
    }
}
