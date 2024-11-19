<?php

/**
 * This is where all the stuff regarding routing starts. The entry point for the routes.
 * The request from a user's browser will reach the $_SERVER superglobal. Now the Bramus router
 * package will have to extract the request method (GET, POST...), the requested url, and a bunch
 * of other data from the $_SERVER.
 */


// Set a session, if there is none.
if(!isset($_SESSION)){ 
    session_start(); 
}

// Create Router instance
$router = new \Bramus\Router\Router();

/**
 * Limits where can an not-logged-in user go, and what can he see. Only the login, logout, register
 * views should be available for this user.
 * 
 * This is a middleware, that will check every GET route, and will be activated
 * before every GET route. 
 * 
 * Notice the ->before() method. Meaning before the routing. 
 * 
 * If the user is not logged in, he can visit only the login, logout and register pages.
 * if the user is logged in, allow him every access.
 * In every other case, redirect user to the login page.
 */
$router->before('GET', '/.*', function() {
    // echo 'User wants to go here: ' . $_SERVER['REQUEST_URI'] . '<br>';

    //if the user is NOT logged in...
    if (!isset($_SESSION['username'])) {
        // echo 'user is not logged in';
        
        /**
         * The not-logged-in user can't visit the pages listed below (everything else he can).
         * So, these pages are forbidden for the not-logged-in user.
         * Pages that can be visited by the not-logged-in user: /, login, register, logout.
         */
        if ($_SERVER['REQUEST_URI'] === '/about'
        || $_SERVER['REQUEST_URI'] === '/contact'
        || $_SERVER['REQUEST_URI'] === '/users'
        || $_SERVER['REQUEST_URI'] === '/users/create'
        || $_SERVER['REQUEST_URI'] === '/upload'
        || $_SERVER['REQUEST_URI'] === '/guzzle') {

            //redirect to login page
            redirect('login');
        }
    } 
});

require_once __DIR__ . '/routesApi.php';//API requests and responses for user CRUD

require_once __DIR__ . '/routesWebPage.php';//pages-views like /, about, contact...

require_once __DIR__ . '/routesAuthentication.php';//everything regarding login and register

require_once __DIR__ . '/routesUser.php';//'normal' web page requests for user CRUD

require_once __DIR__ . '/routesUploadDownloadCsv.php';//for uploading (images and csv files) and downloading (csv files)

require_once __DIR__ . '/routesGuzzle.php';//for Guzzle stuff

require_once __DIR__ . '/routesStudent.php';//for the Quantox/Student task. Unfinished.



// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '<br>' . '404, route not found! Please check the url again.';
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

