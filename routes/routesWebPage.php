<?php

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\controllers\webControllers\PageController;

//WEBPAGE ROUTES**********************

//home page
$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->home();
}); 

//about page
$router->get('/about', function () {
    $aboutController = new AboutController();
    $aboutController->about();
});

//contact page 
$router->get('/contact', function () {
    $contactController = new ContactController();
    $contactController->contact();
});