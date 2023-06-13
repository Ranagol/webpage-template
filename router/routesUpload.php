<?php

use System\request\FileUploadRequest;
use App\Controllers\UploadControllers\UploadController;

//UPLOAD - DOWNLOAD STORY***********************************************************

/**
 * Simply displays the upload page
 */
$router->get('/upload', function () {
    UploadController::displayUploadPage();
});

/**
 * Saves the uploaded image or .csv file into the app
 */
$router->post('/upload', function () {

    /**
     * We use the FileUploadRequest class to actually get the uploaded file from PHP. And it does so,
     * as soon as it is created as an object. So this object (has the uploaded file) is then sent
     * as an argument to the store() method.
     */
    UploadController::store(new FileUploadRequest);
});

