<?php 
/**
 * Suppress deprecation warnings from older packages not fully compatible with PHP 8.5
 * This is an old app, with some old (not upgradable packages), so to avoid flooding the logs
 * with deprecation warnings, we suppress them here.
 */
error_reporting(E_ALL & ~E_DEPRECATED);

/**
 * This will start autoload.
 */
require __DIR__ . '/../vendor/autoload.php';


/**
 * This will start bootstrap. Meaning: it will activate all the stuff that this app
 * needs. That means, that it will activate Eloquent, the router, the view() and redirect() 
 * functions - these functions will be available everywhere.
 */
require __DIR__ . '/../bootstrap/bootstrap.php';

/**
 * if the session is not started yet somewhere else, then please start it.
 */
if(!isset($_SESSION)){ 
    session_start(); 
}