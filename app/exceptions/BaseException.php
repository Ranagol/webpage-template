<?php

namespace App\Exceptions;

use Exception;
use App\logger\Logger;

/**
 * This class is the parent of all exceptions in this app. 
 * The reason for this is: this way all child exceptions are automatically logged 
 * into the storage/logs/myLogs.txt. 
 */
class BaseException extends Exception
{
    //TODO valamiert az error message nem akarja beirni a Loggerba (mindez mukodik a sima Exception classal)
    //routes.php itt van beallitva sima Exception pelda - kiprobalni
    //LoginController van masik exception pelda - kiprobalni loginalassal, hibas passworddal
    //mikor ezzel megvagyunk, akkor ezt a reszt el kene magyarazni...
    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        Logger::getInstance()->logError($this);
        parent::__construct($message, $code, $previous);
    }
}
