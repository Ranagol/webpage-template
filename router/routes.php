<?php

// use App\logger\Logger;
// use System\request\ApiRequest;
// use System\request\WebPageRequest;
// use System\request\FileUploadRequest;
// use App\controllers\webControllers\PageController;
// use App\controllers\uploadControllers\FileController;
// use App\controllers\authControllers\LoginController;
// use App\controllers\apiControllers\UserApiController;
// use App\controllers\webControllers\UserWebController;
// use App\controllers\authControllers\RegisterController;

if(!isset($_SESSION)){ 
    session_start(); 
}

// Create Router instance
$router = new \Bramus\Router\Router();

/**
 * This is a middleware, that will check every GET route, and will be activated
 * before every GET route.
 * If the user is not logged in, he can visit only the login, logout and register pages.
 * if the user is logged in, allow him every access.
 * In every other case, redirect user to the login page.
 */
$router->before('GET', '/.*', function() {
    // echo 'User wants to go here: ' . $_SERVER['REQUEST_URI'] . '<br>';

    //if the user is logged in...
    if (isset($_SESSION['username'])) {
        // echo 'user is logged in';//TODO THIS HAS TO BE CORRECTED, REFACTORED!
    } else {
        //...or if the user is not logged in, he can visit login, register, logout
        // echo 'user is NOT logged in';
        if ($_SERVER['REQUEST_URI'] === '/login' 
            || $_SERVER['REQUEST_URI'] === '/register'
            || $_SERVER['REQUEST_URI'] === '/logout') {
            } elseif ($_SERVER['REQUEST_URI'] === '/'
                || $_SERVER['REQUEST_URI'] === '/about'
                || $_SERVER['REQUEST_URI'] === '/contact'
                || $_SERVER['REQUEST_URI'] === '/users'
                || $_SERVER['REQUEST_URI'] === '/users/create'
                || $_SERVER['REQUEST_URI'] === '/upload'
            ) {
                //not logged in user can't visit /, about, contact... pages, and will be redirected to login page
                // echo 'user is not logged in and wants to see the wepages, should be redirected to login';
                redirect('login');
            }
    }
});

require_once __DIR__ . '/routesApi.php';

require_once __DIR__ . '/routesWebPage.php';

require_once __DIR__ . '/routesAuthentication.php';

require_once __DIR__ . '/routesUserWebPageCrud.php';

require_once __DIR__ . '/routesUpload.php';

// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!' . __FILE__ . __LINE__ ;
});

/**
 * The $router->run(); is the final step in the routing process, this starts everything 
 * regarding routing. In some cases, we do not use routing (example: activating a 
 * migration through the composer.) Now, the router is activated then too, but obviously
 * there is no routing request, there is no request method. In this case the bramus
 * router freezes. Solution: use if condition, like below.
 */
if (isset($_SERVER['REQUEST_METHOD'])) {
    $router->run();
}

