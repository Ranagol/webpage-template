<?php

use App\Controllers\AboutController;
use App\controllers\webControllers\PageController;

//WEBPAGE ROUTES**********************

//home page
$router->get('/', function () {
    PageController::home();
}); 

//about page
$router->get('/about', function () {
    $aboutController = new AboutController();
    $aboutController->about();
});

//contact page 
$router->get('/contact', function () {
    PageController::contact();
});