<?php

declare(strict_types=1);

use App\Controllers\GuzzleControllers\GuzzleController;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

// loading the page
$router->get('/guzzle', function () {
    $guzzleController = new GuzzleController();
    $guzzleController->loadGuzzlePage();
});

// getting 10 posts from DummyApi
$router->get('/getPosts', function () {
    $guzzleController = new GuzzleController();
    $guzzleController->getPosts();
});
