<?php

namespace App\Controllers\DownloadControllers;

use System\request\RequestInterface;
use System\response\downloadResponse\DownloadResponse;

class DownloadController
{
    public function download(RequestInterface $request): void
    {
        $dataToDownload = $request->getAllRequestData();
        $dowloadResponse = new DownloadResponse($dataToDownload);
        $dowloadResponse->sendResponse();
    }
}
