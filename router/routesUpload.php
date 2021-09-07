<?php

use System\request\FileUploadRequest;
use App\Controllers\UploadControllers\UploadController;

//UPLOAD - DOWNLOAD STORY***********************************************************

$router->get('/upload', function () {
    UploadController::displayUploadPage();
});

$router->post('/upload', function () {
    UploadController::store(new FileUploadRequest);
});

