<?php

declare(strict_types=1);

use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

// WEBPAGE ROUTES**********************

// home page
$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->home();
});

// about page
$router->get('/about', function () {
    $aboutController = new AboutController();
    $aboutController->about();
});

// contact page
$router->get('/contact', function () {
    $contactController = new ContactController();
    $contactController->contact();
});
