<?php

declare(strict_types=1);

/**
 * When 'composer seed' will by typed into the terminal
 * we will directly activate this php file only. That means that the dotennv package (what we need
 * to get the env variables from the .env file) and the Eloquent package (that we need for the
 * migration) are not booted, since we only trigger this php file. That is why we need to require the
 * autoloader and the bootstrap.php. Triggering the bootstrap will automatically trigger the Eloquent
 * and the dotenv.
 */
use App\Application;

// No composer autoload, so we need to require the Application class manually, and then we can bootstrap the app.
require_once __DIR__ . '/../../app/Application.php';

// Starts autoload, Eloquent, dotenv, and routes setup.
Application::bootstrap();

use App\Models\User;

/*
 * USER SEEDER
 *
 * Seeds the users table. For simplicity, we use the email for all the user fields. The data is pulled
 * from the .env file.
 */
User::create([
    'username' => $_ENV['USER_EMAIL_1'],
    'firstname' => $_ENV['USER_EMAIL_1'],
    'lastname' => $_ENV['USER_EMAIL_1'],
    'email' => $_ENV['USER_EMAIL_1'],
    'password' => password_hash($_ENV['USER_EMAIL_1'], PASSWORD_DEFAULT),
]);

User::create([
    'username' => $_ENV['USER_EMAIL_2'],
    'firstname' => $_ENV['USER_EMAIL_2'],
    'lastname' => $_ENV['USER_EMAIL_2'],
    'email' => $_ENV['USER_EMAIL_2'],
    'password' => password_hash($_ENV['USER_EMAIL_2'], PASSWORD_DEFAULT),
]);

echo "\033[42;30mUsers seeding was successful.\033[0m" . PHP_EOL;
