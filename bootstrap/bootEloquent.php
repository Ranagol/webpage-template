<?php 

/**
 * Here we set up the Eloquent, so we can use it to interact with the database, just like in Laravel.
 */
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Basically, this capsule is an Eloquent object. 
 */
$capsule = new Capsule;

/**
 * Here we tell Eloqent which connection data, which db, password... to use.
 * We are pulling the sensitive data from the .env, with the help of the Dotenv dependancy.
 */
$capsule->addConnection([
    'driver' => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_DATABASE'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

