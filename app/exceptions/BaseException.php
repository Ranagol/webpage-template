<?php

namespace App\Exceptions;

class BaseException extends Exception
{
    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        Logger::getInstance()->log($message);
        parent::__construct($message, $code, $previous);
    }
}
