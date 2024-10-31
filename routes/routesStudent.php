<?php

use App\Controllers\StudentControllers\StudentController;

$router->get('/students/{id}', function ($id) {
    StudentController::show($id);
});