<?php

use app\WebControllers\PageController;
use app\apiControllers\UserApiController;
use app\WebControllers\UserWebController;
use app\System\JsonRequest;
use app\System\Request;

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
    UserApiController::store(new JsonRequest());
});


/**
 * update
 * 
 * We are sending the request data (from the request body) 
 * to the controller with the 
 * the 'new JsonRequest() line. Reminder: JsonRequest has acces to 
 * request data. JsonRequest  is used like this only for store and update,
 * since only for these two we have the data in the request body, all other
 * request have their data in the url.
 */
$router->put('/server/users', function () {
    UserApiController::update(new JsonRequest());
});

/**
 * delete 
 * 
 * We are sending the request data (from the request body) 
 * to the controller with the 
 * the 'new JsonRequest() line. Reminder: JsonRequest has acces to 
 * request data. JsonRequest  is used like this only for store and update,
 * since only for these two we have the data in the request body, all other
 * request have their data in the url.
 */
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

//************************** */

//show all users
$router->get('/users', function () {
    UserWebController::index();
});


/**
 * go to the create user page
 * Now, for some misterious reason, the users/create route must be before
 * 'show' /users/{id} route.
 * Otherwise, the show page will be activated instead of the create page.
 * DO NOT CHANGE THE ORDER OF THE CREATE AND SHOW!
 */
$router->get('/users/create', function () {
    UserWebController::create();
});


/**
 * show individual users 
 *  * Now, for some misterious reason, the users/create route must be before
 * 'show' /users/{id} route.
 * Otherwise, the show page will be activated instead of the create page.
 *  * DO NOT CHANGE THE ORDER OF THE CREATE AND SHOW!
 */
$router->get('/users/{id}', function ($id) {
    UserWebController::show($id);
});

//save user 
$router->post('/users', function () {
    var_dump('store activated');
    UserWebController::store(new Request());
});

//update user
$router->patch('/users/{id}', function ($id) {
    UserWebController::update($id);
});

/**
 * delete user
 * 
 * Most browser do not support DELETE as method parameter for <form ...>
 * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
 * So instead of DELETE method, we use POST method
 */
$router->post('/users/{id}', function ($id) {
    UserWebController::delete($id);
});













// Custom 404 Handler*********************************************************************
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});



$router->run();
