<?php

namespace App;

use App\logger\Logger;

class Testing
{
    /**
     * Warning! When creating a class that will be called with composer, make sure that it is 
     * callable by the autoload. That means that your future class must be in a dir, that is 
     * mapped and listed for autoloading. Example: app dir. 
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
