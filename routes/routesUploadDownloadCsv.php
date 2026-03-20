<?php

declare(strict_types=1);

use App\Controllers\UploadDownloadCsv\DownloadController;
use App\Controllers\UploadDownloadCsv\UploadController;
use System\request\FileDownloadRequest;
use System\request\FileUploadRequest;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

/*
 * Simply displays the upload page
 */
$router->get('/upload', function () {
    $uploadController = new UploadController();
    $uploadController->displayUploadPage();
});

/*
 * Saves the uploaded image or .csv file into the app
 */
$router->post('/upload', function () {

    /**
     * We use the FileUploadRequest class to actually get the uploaded file from PHP. And it does so,
     * as soon as it is created as an object. So this object (has the uploaded file) is then sent
     * as an argument to the store() method.
     */
    $uploadController = new UploadController();
    $uploadController->store(new FileUploadRequest());
});

/*
 * Downloads the  csv report that was created from the uploaded .csv file
 */
$router->get('/download-report', function () {
    $downloadController = new DownloadController();
    $downloadController->download(new FileDownloadRequest());
});
