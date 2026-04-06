<?php

declare(strict_types=1);

use App\Controllers\PageNotFoundController;

/*
 * This is where all the stuff regarding routing starts. The entry point for the routes.
 * The request from a user's browser will reach the $_SERVER superglobal. Now the Bramus router
 * package will have to extract the request method (GET, POST...), the requested url, and a bunch
 * of other data from the $_SERVER.
 */

// Set a session, if there is none, and not running under PHPUnit (to avoid header issues in tests).
if (!isset($_SESSION) && (!defined('PHPUNIT_COMPOSER_INSTALL') && !getenv('PHPUNIT_RUNNING'))) {
    session_start();
}

// Create Router instance
$router = new Bramus\Router\Router();

/*
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
$router->before('GET', '/.*', function () {
    // echo 'User wants to go here: ' . $_SERVER['REQUEST_URI'] . '<br>';

    // if the user is NOT logged in...
    if (!isset($_SESSION['username'])) {
        // Allowed pages for not-logged-in users
        $allowed = ['/', '/login', '/register', '/logout'];
        $current = $_SERVER['REQUEST_URI'] ?? '';
        if (!in_array($current, $allowed, true)) {
            // redirect to login page
            redirect('login');
        }
        // If already on an allowed page, do nothing (let the route execute)
    }
});

/*
 * Protect state-changing upload/report routes for not-logged-in users as well.
 */
$router->before('POST', '/(upload|download-report)', function () {
    if (!isset($_SESSION['username'])) {
        redirect('login');
    }
});

require_once __DIR__ . '/routesWebPage.php'; // pages-views

require_once __DIR__ . '/routesAuthentication.php'; // everything regarding login and register

/**
 * Web page requests for user CRUD. However, for the current purpose of this project, these routes
 * are actually a security risk. Because of this, the user routes are not active. This logic is not
 * deleted, because we might need it in the future.
 */
// require_once __DIR__ . '/routesUser.php';

require_once __DIR__ . '/routesUploadDownloadCsv.php'; // for uploading (images and csv files) and downloading (csv files)

// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    $pageNotFoundController = new PageNotFoundController();
    $pageNotFoundController->loadPage();
});

/*
 * The $router->run(); is the final step in the routing process, this starts everything
 * regarding routing. In some cases, we do not use routing (example: activating a
 * migration through the composer.) Now, the router is activated then too, but obviously
 * there is no routing request, there is no request method. In this case the bramus
 * router freezes. Solution: use if condition, like below.
 */
if (isset($_SERVER['REQUEST_METHOD'])) {
    $router->run();
}
