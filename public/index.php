<?php 
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

//if the session is not started yet somewhere else, then please start it
if(!isset($_SESSION)){ 
    session_start(); 
}

//TODO LOSI Amit meg nem tudok, az az apache beallitas. Mikor kellene kontenerizalni egy vanilla php
//alkalmazast. Mit kell masolni, hova, miert, es mi kell hogy legyen a config file-ban? Hogyan 
//valaszolni erre a kerdesre?


//TODO LOSI storage/logs/myLogs.txt --- why is this not ignored by gitignore?