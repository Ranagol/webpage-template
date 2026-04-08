<?php

declare(strict_types=1);

namespace App\Controllers\UploadDownloadCsv;

use App\Controllers\Controller;
use App\Exceptions\BaseException;
use Domain\Report\Interfaces\UploadServiceInterface;
use System\request\RequestInterface;

class UploadController extends Controller
{
    /**
     * The UploadService is injected into the controller, so we can use it to handle the upload process.
     */
    private UploadServiceInterface $uploadService;

    public function __construct(UploadServiceInterface $uploadService)
    {
        parent::__construct();
        $this->uploadService = $uploadService;
    }

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

        $csrfToken = $uploadData['csrf_token'] ?? null;
        $this->uploadService->checkCsrfToken($csrfToken);

        try {

            // Give the service all upload data, so it can handle the upload process.
            $this->uploadService->setUploadData($uploadData);

            // Handle upload
            $file = $this->uploadService->storeFile();

            // This is the report that we want to display for the user, after the upload is successful.
            $report = $file->getReport();

            /**
             * Feedback message for the user, display in the upload view.
             */
            $message = 'Your upload was successful.';
            $alertType = 'alert-success';

        } catch (BaseException $error) {
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
}
