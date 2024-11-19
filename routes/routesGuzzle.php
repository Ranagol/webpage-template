<?php

use App\Controllers\GuzzleControllers\GuzzleController;

//loading the page
$router->get('/guzzle', function () {
    $guzzleController = new GuzzleController();
    $guzzleController->loadGuzzlePage();
});

//getting 10 posts from DummyApi
$router->get('/getPosts', function () {
    $guzzleController = new GuzzleController();
    $guzzleController->getPosts();
});

