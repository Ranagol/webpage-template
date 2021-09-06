<?php

namespace App\Controllers\DownloadControllers;

use System\request\RequestInterface;

class DownloadController
{
    public function download(RequestInterface $request): void
    {
        $dataToDownload = $request->getAllRequestData();
        $r = 5;

    }
}
