<?php  

require __DIR__ . '/../../vendor/autoload.php';

/**
 * In case of the migration command 'composer migrate' that will by typed into the terminal
 * we will directly activate this php file only. That means that the dotennv package (what we need 
 * to get the env variables from the .env file) and the Eloquent package (that we need for the 
 * migration) are not booted. That is why we need to require the bootstrap.php
 */
require __DIR__ . '/../../bootstrap/boostrap.php';


//TODO LOSI en itt maskepp csinaltam meg a migralast mint te. Joval egyszerubben. Ez igy elfogadhato?
use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
  $table->increments('id');
  $table->string('username');
  $table->string('firstname');
  $table->string('lastname');
  $table->string('email');
  $table->string('password');
  $table->timestamps();
});

echo 'Migration was successfull' . PHP_EOL;
