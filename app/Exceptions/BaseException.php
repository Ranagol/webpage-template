<?php

namespace App\Exceptions;

use Exception;
use App\logger\Logger;

/**
 * This class is the parent of all exceptions in this app. 
 * The reason for this is: since this parent class has the ability to log exception, and to use
 * the Logger class, therefore all child classes can also log exceptions.
 * into the storage/logs/myLogs.txt. 
 */
class BaseException extends Exception
{
    /**
     * In this constructor we set up that for every exception when it is created,
     * it will be logged immediatelly into the logs.
     *
     * @param string $message
     * @param integer $code
     * @param \Throwable $previous
     */
    public function __construct(string $message = null, int $code = 0, \Throwable $previous = null)
    {
        /**
         * If a class extends the built-in Exception class and re-defines the constructor, it is 
         * highly recommended that it also call parent::__construct() to ensure all available data 
         * has been properly assigned.
         */
        parent::__construct($message, $code, $previous);
        Logger::getInstance()->logError($this);
    }
}



