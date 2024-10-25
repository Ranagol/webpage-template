<?php

namespace App;

use App\logger\Logger;

/**
 * This class is used, to test the composer scripts. 
 * This is just a test to see how basic php script activation is working. Just write: 
 * `composer test-logger` into the terminal. That will trigger this class, via composer script.
 */
class Testing
{
    /**
     * Warning! When creating a class that will be called with composer, make sure that it is 
     * callable by the autoload. That means that your future class must be in a dir, that is 
     * mapped and listed for autoloading. Example: app dir. 
     * 
     * This class is called from the terminal, with this command: composer test-logger
     *
     * @return void
     */
    public static function displayMessage(): void
    {
        require __DIR__ . '/../vendor/autoload.php';
        
        /**
         * Writes into the log.
         */
        Logger::getInstance()->log('displayMessage() was activated through composer from Testing class.');

        /**
         * Writes a feedback to the user, in terminal.
         */
        var_dump('Message is displayed from Testing class.');
    }
}
