<?php  
require './../../vendor/autoload.php';


use Dotenv\Dotenv;


//dotenv setup
$dotenv = Dotenv::createImmutable(__DIR__);//Create a new immutable dotenv instance with default repository
$dotenv->load();//loads all .env variables into the $_ENV superglobal, from where they will be available to us


require '../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
  $table->increments('id');
  $table->string('firstname');
  $table->string('lastname');
  $table->string('email');
  $table->string('password');
  $table->timestamps();
});

