<?php

use app\apiControllers\UserApiController;

// Require composer autoloader
// require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// API ROUTES

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










//WEBPAGE ROUTES


$router->get('/', function () {
    echo 'Homepage';
}); 


// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});



$router->run();
