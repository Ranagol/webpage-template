<?php

//this file was just used for testing the composer script running option. It can be deleted.

use App\logger\Logger;

/**
 * This will start autoload. 
 * Problem: if we activate this script through composer,
 * that means that the main index.php was not activated. That means that the 
 * autoload.php (which is on the index.php) was not activated. So, we could
 * not activate the Logger class without autoload.
 * Solution: we insert here below the 'require __DIR__ . '/vendor/autoload.php';'
 */
require __DIR__ . '/vendor/autoload.php';

Logger::getInstance()->log('displayMessage() was activated through composer from testScript.');
var_dump('Message is displayed from testScript.');