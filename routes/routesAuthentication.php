<?php

use App\Controllers\AuthControllers\LoginController;
use App\Controllers\AuthControllers\RegisterController;
use System\request\WebPageRequest;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

// register page loading
$router->get('/register', function () {
    $registerController = new RegisterController();
    $registerController->loadRegisterPage();
});

// registering the user
$router->post('/register', function () {
    $registerController = new RegisterController();
    $registerController->register(new WebPageRequest());
});

// login page loading
$router->get('/login', function () {
    $loginController = new LoginController();
    $loginController->loadLoginPage();
});

// logging in a user
$router->post('/login', function () {
    $loginController = new LoginController();
    $loginController->login(new WebPageRequest());
});

// logout
$router->get('/logout', function () {
    $loginController = new LoginController();
    $loginController->logout();
});
