<?php

use System\request\WebPageRequest;
use App\controllers\webControllers\UserWebController;

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
    // var_dump('store activated');
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
    UserWebController::delete($id);
});
