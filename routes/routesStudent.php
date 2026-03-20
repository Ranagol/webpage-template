<?php

use App\Controllers\StudentControllers\StudentController;

if (!isset($router) || !($router instanceof Bramus\Router\Router)) {
    throw new RuntimeException('$router is not initialized.');
}

$router->get('/students/{id}', function ($id) {
    StudentController::show($id);
});
