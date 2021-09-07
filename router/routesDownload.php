<?php

use System\request\FileDownloadRequest;
use App\Controllers\DownloadControllers\DownloadController;

//downloads a csv file
$router->get('/download-report', function () {
    DownloadController::download(new FileDownloadRequest());
});