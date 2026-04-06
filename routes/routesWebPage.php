<?php

declare(strict_types=1);

use App\Controllers\HeroController;
use App\Controllers\HomeController;
use App\Controllers\MvcController;
use App\Controllers\TrainController;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

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
    $heroesAndMonstersController = new HeroController();
    $heroesAndMonstersController->loadPage();
});

// starts the heroes and monsters battle, and shows the events on the heroes and monsters page
$router->get('/demonstrate', function () {
    $heroesAndMonstersController = new HeroController();
    $heroesAndMonstersController->demonstrate();
});
