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
        parent::__construct($message, $code, $previous);
        Logger::getInstance()->logError($this);
    }
}
