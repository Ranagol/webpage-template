<?php

use api\controllers\UserApiController;

// Require composer autoloader
// require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// API ROUTES

$router->get('/api/users', function () {
    UserApiController::index();
    $t = 1;

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
