<?php

namespace App\Exceptions;

use Exception;
use App\logger\Logger;

class BaseException extends Exception
{
    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        Logger::getInstance()->log($message);
        parent::__construct($message, $code, $previous);
    }
}
