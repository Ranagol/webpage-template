<?php

declare(strict_types=1);

namespace App\Controllers\UploadDownloadCsv;

use App\Controllers\Controller;
use App\Exceptions\BaseException;
use Domain\Report\Service\UploadService;
use System\request\RequestInterface;

class UploadController extends Controller
{
    /**
     * Returns the file upload view.
     */
    public function loadPage(): void
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
     */
    public function store(RequestInterface $request): void
    {

        /**
         * Here we extract the upload data and the upload file.
         * So this below is = to $_FILES now, we can treat $uploadData as the $_FILES.
         */
        $uploadData = $request->getAllRequestData();

        $this->checkCsrfToken($uploadData);

        try {

            /**
             * The UploadService has all the logic to handle the upload process.
             */
            $upload = new UploadService($uploadData);

            $file = $upload->storeFile();

            // This is the report that we want to display for the user, after the upload is successfull.
            $report = $file->getReport();

            /**
             * Feedback message for the user, display in the upload view.
             */
            $message = 'Your upload was successfull.';
            $alertType = 'alert-success';

        } catch (\Exception $error) {
            $additionalInfo = $error->getMessage();
            $message = 'Upload failed. Please verify the file and try again. ' . $additionalInfo;
            $alertType = 'alert-warning';

            // In case of an error, there is no report to show to the user.
            $report = null;
        }

        /*
         * Return view.
         */
        $this->view(
            'upload',
            [
                'message' => $message,
                'alertType' => $alertType,
                'report' => $report,
            ]
        );
    }

    /**
     * This function checks the CSRF token, if it is not valid, then an exception will be thrown.
     *
     * @param array<string, mixed> $uploadData
     *
     * @throws BaseException
     */
    private function checkCsrfToken(array $uploadData): void
    {
        if (!validateCsrfToken($uploadData['csrf_token'] ?? null)) {
            if (!headers_sent()) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            }
            echo 'Invalid CSRF token.';

            exit;
        }
    }
}
