<?php

use app\WebControllers\PageController;
use app\apiControllers\UserApiController;

// Require composer autoloader
// require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// API ROUTES********************************************************************************

//index
$router->get('/server/users', function () {//TODO itt miert nem lehet api/users hasznalni?
    UserApiController::index();
});

//show
$router->get('/server/users/{id}', function ($id) {
    UserApiController::show($id);
});

//store
$router->post('/server/users', function () {
    UserApiController::store();
});

//update
$router->put('/server/users', function () {
    UserApiController::update();
});

//delete
$router->delete('/server/users/{id}', function ($id) {
    UserApiController::delete($id);
});



//WEBPAGE ROUTES***********************************************************************

//home page
$router->get('/', function () {
    PageController::home();
}); 

//about page
$router->get('/about', function () {
    PageController::about();
});

//contact page 
$router->get('/contact', function () {
    PageController::contact();
});

//show all users
$router->get('/users', function () {
    UserWebController::index();
});

//show individual users 
$router->get('/users/{id}', function ($id) {
    UserWebController::show($id);
});

//create user 
$router->post('/users', function () {
    UserWebController::store();
});

//update user
$router->patch('/users/{id}', function ($id) {
    UserWebController::update($id);
});













// Custom 404 Handler*********************************************************************
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});



$router->run();
