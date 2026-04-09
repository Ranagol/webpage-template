<?php

declare(strict_types=1);

// Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/../bootstrap/bootEloquent.php';

// router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../routes/routes.php';

// Here we do dotenv setup
require __DIR__ . '/../bootstrap/bootDotenv.php';
