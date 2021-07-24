<?php

use Dotenv\Dotenv;


//dotenv setup
$dotenv = Dotenv::createImmutable(__DIR__);//Create a new immutable dotenv instance with default repository
$dotenv->load();//loads all .env variables into the $_ENV superglobal, from where they will be available to us

//Eloquent setup 
require 'app/database/database.php';

//router setup
require 'app/router/routes.php';
