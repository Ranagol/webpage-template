<?php

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
     *
     * @param RequestInterface $request
     * 
     * @return void
     */
    public function download(RequestInterface $request): void
    {
        $dataToDownload = $request->getAllRequestData();
        $dowloadResponse = new DownloadResponse($dataToDownload);
        $dowloadResponse->sendResponse();
    }
}
