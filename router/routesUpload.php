<?php

use System\request\FileUploadRequest;
use App\controllers\fileControllers\FileController;

//UPLOAD - DOWNLOAD STORY***********************************************************

$router->get('/upload', function () {
    FileController::displayUploadPage();
});

$router->post('/upload', function () {
    FileController::store(new FileUploadRequest);
});