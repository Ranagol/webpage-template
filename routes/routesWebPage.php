<?php

declare(strict_types=1);

// use App\Controllers\AboutController;
// use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\TrainTaskController;
use App\Controllers\HeroesAndMonstersController;
use App\Controllers\RawPhpMvcController;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

// WEBPAGE ROUTES**********************

// home page
$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->home();
});

//raw php mvc page
$router->get('/raw-php-mvc', function () {
    $rawPhpMvcController = new RawPhpMvcController();
    $rawPhpMvcController->rawPhpMvc();
});

//train task page
$router->get('/train-task', function () {
    $trainTaskController = new TrainTaskController();
    $trainTaskController->trainTask();
});

//heroes and monsters page
$router->get('/heroes-and-monsters', function () {
    $heroesAndMonstersController = new HeroesAndMonstersController();
    $heroesAndMonstersController->heroesAndMonsters();
});



// // about page
// $router->get('/about', function () {
//     $aboutController = new AboutController();
//     $aboutController->about();
// });

// // contact page
// $router->get('/contact', function () {
//     $contactController = new ContactController();
//     $contactController->contact();
// });