<?php

use App\Application;

require_once __DIR__ . '/../app/Application.php';

Application::bootstrap();
Application::run();
