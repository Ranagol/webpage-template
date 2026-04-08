<?php

declare(strict_types=1);

use App\Controllers\AuthControllers\LoginController;

use App\Controllers\AuthControllers\RegisterController;
use App\Controllers\HeroController;
use App\Controllers\HomeController;
use App\Controllers\MvcController;
use App\Controllers\PageNotFoundController;
use App\Controllers\TrainController;
use App\Controllers\UploadDownloadCsv\DownloadController;
use App\Controllers\UploadDownloadCsv\UploadController;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Validators\RegisterValidator;
use Domain\HeroesAndMonsters\Services\HeroService;
use Domain\Report\Service\UploadService;
use System\request\FileDownloadRequest;
use System\request\FileUploadRequest;
use System\request\WebPageRequest;

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

// ******************AUTHENTICATION******************************** */

// register page loading
$router->get('/register', function () {
    $registerController = new RegisterController(new RegisterService(new RegisterValidator()));
    $registerController->loadPage();
});

// registering the user
$router->post('/register', function () {
    $registerController = new RegisterController(new RegisterService(new RegisterValidator()));
    $registerController->register(new WebPageRequest());
});

// login page loading
$router->get('/login', function () {
    $loginController = new LoginController(new LoginService());
    $loginController->loadPage();
});

// logging in a user
$router->post('/login', function () {
    $loginController = new LoginController(new LoginService());
    $loginController->login(new WebPageRequest());
});

// logout
$router->post('/logout', function () {
    $loginController = new LoginController(new LoginService());
    $loginController->logout();
});

// ******************APP PAGES******************************** */

// home page
$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->loadPage();
});

// raw php mvc page
$router->get('/raw-php-mvc', function () {
    $rawPhpMvcController = new MvcController();
    $rawPhpMvcController->loadPage();
});

// train task page
$router->get('/train-task', function () {
    $trainTaskController = new TrainController();
    $trainTaskController->loadPage();
});

// heroes and monsters page
$router->get('/heroes-and-monsters', function () {
    $heroesAndMonstersController = new HeroController(new HeroService());
    $heroesAndMonstersController->loadPage();
});

// starts the heroes and monsters battle, and shows the events on the heroes and monsters page
$router->get('/demonstrate', function () {
    $heroesAndMonstersController = new HeroController(new HeroService());
    $heroesAndMonstersController->demonstrate();
});

// ******************REPORT / UPLOAD / DOWNLOAD******************************** */

/*
 * Simply displays the upload page
 */
$router->get('/upload', function () {
    $uploadController = new UploadController(new UploadService());
    $uploadController->loadPage();
});

/*
 * Saves the uploaded .csv file into the app
 */
$router->post('/upload', function () {

    /**
     * We use the FileUploadRequest class to actually get the uploaded file from PHP. And it does so,
     * as soon as it is created as an object. So this object (has the uploaded file) is then sent
     * as an argument to the store() method.
     */
    $uploadController = new UploadController(new UploadService());
    $uploadController->store(new FileUploadRequest());
});

/*
 * Downloads the csv report that was created from the uploaded .csv file
 */
$router->post('/download-report', function () {
    $downloadController = new DownloadController();
    $downloadController->download(new FileDownloadRequest());
});

// ******************404 HANDLER******************************** */

// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    $pageNotFoundController = new PageNotFoundController();
    $pageNotFoundController->loadPage();
});

// ******************BRAMUS ROUTER FINAL SETUP STEP******************************** */

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
