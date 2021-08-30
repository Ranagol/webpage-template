<?php

use System\request\WebPageRequest;
use App\controllers\authControllers\LoginController;
use App\controllers\authControllers\RegisterController;

//register page loading
$router->get('/register', function () {
    RegisterController::loadRegisterPage();
});

//registering
$router->post('/register', function () {
    RegisterController::register(new WebPageRequest());
});

//login page loading
$router->get('/login', function () {
    LoginController::loadLoginPage();
});

//logging in
$router->post('/login', function () {
    // var_dump('login post form activated');
    LoginController::login(new WebPageRequest());
});

//logout
$router->get('/logout', function () {
    // var_dump('logout route activated');
    LoginController::logout();
});