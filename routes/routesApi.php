<?php

use System\request\ApiRequest;
use App\Controllers\ApiControllers\UserApiController;

// API ROUTES******************************************

/**
 * INDEX
 */
$router->get('/server/users', function () {
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
 * it activates the UserApiController, and as an argumenet sends the controller a 
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
 * to the controller with the the 'new ApiRequest() line. 
 * 
 * Reminder: ApiRequest has acces to 
 * request data. ApiRequest  is used like this only for store and update,
 * since only for these two we have the data in the request body, all other
 * request have their data in the url.
 * 
 * How the app knows which user we want ti update? We are sending a PUT request to the /server/users,
 * and in the body of the request we send the user id. UserApiController::update() extracts this
 * id, and uses it.
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