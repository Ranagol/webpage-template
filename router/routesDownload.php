<?php

use System\request\FileDownloadRequest;
use App\Controllers\DownloadControllers\DownloadController;

$router->get('/download-report', function () {
    DownloadController::download(new FileDownloadRequest());
});