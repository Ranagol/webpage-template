<?php

use System\request\ApiRequest;
use System\request\WebPageRequest;
use App\controllers\webControllers\PageController;
use App\controllers\apiControllers\UserApiController;
use App\controllers\webControllers\UserWebController;
use App\controllers\authControllers\RegisterController;

// Require composer autoloader
// require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// API ROUTES********************************************************************************

/**
 * INDEX
 */
$router->get('/server/users', function () {//TODO itt miert nem lehet api/users hasznalni?
    UserApiController::index();
});

/**
 * SHOW
 * There are two ways how a controller can get request data.
 * 1. From the url, with the help of the bramus router, just what is happening here in the show.
 * 2. From the ApiRequest class, in the store(), below.
 */
$router->get('/server/users/{id}', function ($id) {
    UserApiController::show($id);
});

/**
 * STORE()
 * 
 * Question: how will the controller access the data from a post request?
 * When the bramus router receives a post api request to /servers/users,
 * it activates the controller, and as an argumenet sends the controller a 
 * newly created ApiRequest object. During creation, the ApiRequest object 
 * automatically gets the request data, and this data will be stored in the 
 * ApiRequest object. Which is passed as an argument to the controller.
 */
$router->post('/server/users', function () {
    UserApiController::store(new ApiRequest());
});


/**
 * update
 * 
 * We are sending the request data (from the request body) 
 * to the controller with the 
 * the 'new ApiRequest() line. Reminder: ApiRequest has acces to 
 * request data. ApiRequest  is used like this only for store and update,
 * since only for these two we have the data in the request body, all other
 * request have their data in the url.
 */
$router->put('/server/users', function () {
    UserApiController::update(new ApiRequest());
});

/**
 * delete 
 * 
 * We are sending the request data (from the request body) 
 * to the controller with the 
 * the 'new ApiRequest() line. Reminder: ApiRequest has acces to 
 * request data. ApiRequest  is used like this only for store and update,
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

//register page loading
$router->get('/register', function () {
    RegisterController::loadRegisterPage();
});

//registering
$router->post('/register', function () {
    RegisterController::register(new WebPageRequest());
});





//************************** */

//show all users
$router->get('/users', function () {
    UserWebController::index();
});


/**
 * go to the create user page
 * 
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
 *  
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
    UserWebController::store(new WebPageRequest());
});

/**
 * UPDATE user
 * 
 * There is no PUT in php. And in bramus router either. So we 
 * fake put here with post method.
 */
$router->post('/users/{id}', function ($id) {
    UserWebController::update($id, new WebPageRequest());
});

/**
 * delete user
 * 
 * Most browser do not support DELETE as method parameter for <form ...>
 * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
 * So instead of DELETE method, we use POST method
 */
$router->post('/user/delete/{id}', function ($id) {
    echo 'delete route activated';
    UserWebController::delete($id);
});













// Custom 404 Handler*********************************************************************
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});



$router->run();
