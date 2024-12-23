<?php  

/**
 * When 'composer migrate' will by typed into the terminal
 * we will directly activate this php file only. That means that the dotennv package (what we need 
 * to get the env variables from the .env file) and the Eloquent package (that we need for the 
 * migration) are not booted, since we only trigger this php file. That is why we need to require the
 * autoloader and the bootstrap.php. Triggering the bootstrap will automatically trigger the Eloquent
 * and the dotenv.
 */
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../bootstrap/bootstrap.php';

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * For creating a new migration, just type composer migrate into the terminal.
 * Create the users table
 */
Capsule::schema()->create('users', function ($table) {
  $table->increments('id');
  $table->string('username');
  $table->string('firstname');
  $table->string('lastname');
  $table->string('email')->unique();//yes, the email here must be unique
  $table->string('password');
  $table->timestamps();
});

echo 'Users migration was successfull' . PHP_EOL;


/**
 * Create the students table
 */
Capsule::schema()->create('students', function ($table) {
  $table->increments('id');
  $table->string('name')->required();
  $table->string('board')->required();
  $table->json('grades')->nullable();
  $table->timestamps();
});

echo 'Student migration was successfull' . PHP_EOL;
