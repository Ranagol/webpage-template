<?php

declare(strict_types=1);

use App\Controllers\AuthControllers\LoginController;
use App\Controllers\AuthControllers\RegisterController;
use App\Services\LoginService;
use App\Services\RegisterService;
use System\request\WebPageRequest;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

// register page loading
$router->get('/register', function () {
    $registerController = new RegisterController(new RegisterService());
    $registerController->loadPage();
});

// registering the user
$router->post('/register', function () {
    $registerController = new RegisterController(new RegisterService());
    $registerController->register(new WebPageRequest());
});

// login page loading
$router->get('/login', function () {
    $loginController = new LoginController(new LoginService());
    $loginController->loadPage();
});

// logging in a user
$router->post('/login', function () {
    $loginController = new LoginController(new LoginService());
    $loginController->login(new WebPageRequest());
});

// logout
$router->post('/logout', function () {
    $loginController = new LoginController(new LoginService());
    $loginController->logout();
});
