<?php

declare(strict_types=1);

namespace App\Controllers\UploadDownloadCsv;

use System\request\RequestInterface;
use System\response\downloadResponse\DownloadResponse;

class DownloadController
{
    /**
     * In the routesDownload.php we injected a FileDownloadRequest object into this controller.
     * This is actually the $request. So, from the $request we can get all the data, that we need
     * to write into a csv file.
     * The DownloadResponse class creates a csv file, writes the data from the $request into the
     * csv file, and then sends the csv file to the browser and force a download there.
     */
    public function download(RequestInterface $request): void
    {
        if (!isset($_SESSION['username'])) {
            if (!headers_sent()) {
                redirect('login');
            }
            return;
        }

        $requestData = $request->getAllRequestData();

        if (!validate_csrf_token($requestData['csrf_token'] ?? null)) {
            if (!headers_sent()) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            }
            echo 'Invalid CSRF token.';
            return;
        }

        $dataToDownload = $requestData['downloadRequest'] ?? null;
        if (!is_array($dataToDownload)) {
            if (!headers_sent()) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            }
            echo 'Invalid download request.';
            return;
        }

        $dowloadResponse = new DownloadResponse($dataToDownload);
        $dowloadResponse->sendResponse();
    }
}