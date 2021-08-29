<?php 
/**
 * This will start autoload.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * This will start boostrap. Meaning: it will activate all the stuff that this app
 * needs. That means, that it will activate Eloquent, the router, the view() and redirect() 
 * functions - these functions will be available everywhere.
 */
require __DIR__ . '/../bootstrap/boostrap.php';

//if the session is not started yet somewhere else, then please start it
if(!isset($_SESSION)){ 
    session_start(); 
}

$d = 'Test docker here.';
