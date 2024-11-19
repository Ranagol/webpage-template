<?php

use Dotenv\Dotenv;

/**
 * dotenv setup: we use dotenv to load all .env variables into the $_ENV superglobal, from where it 
 * will be available for further actions.
 * Create a new immutable dotenv instance with default repository, 
 * it's path must point to the app root dir
 * loads all .env variables into the $_ENV superglobal, from where they will be available to us
 */
$dotenv = Dotenv::createImmutable(__DIR__  . '/../');
$dotenv->load();