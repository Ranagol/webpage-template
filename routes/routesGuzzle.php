<?php

use App\Controllers\GuzzleControllers\GuzzleController;

//loading the page
$router->get('/guzzle', function () {
    GuzzleController::loadGuzzlePage();
});

//getting 10 posts from DummyApi
$router->get('/getPosts', function () {
    GuzzleController::getPosts();
});

