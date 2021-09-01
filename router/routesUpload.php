<?php

use System\request\FileUploadRequest;
use App\Controllers\UploadControllers\CsvUploadController;
use App\controllers\uploadControllers\ImageUploadController;

//UPLOAD - DOWNLOAD STORY***********************************************************

$router->get('/upload-image', function () {
    ImageUploadController::displayUploadPage();
});

$router->post('/upload-image', function () {
    ImageUploadController::store(new FileUploadRequest);
});

$router->get('/upload-csv', function () {
    CsvUploadController::displayUploadPage();
});

$router->post('/upload-csv', function () {
    CsvUploadController::store(new FileUploadRequest);
});