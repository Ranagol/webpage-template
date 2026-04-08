<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Exceptions;

use Domain\HeroesAndMonsters\Logs\EventLogger;

class BaseException extends \Exception
{
    /**
     * In this constructor we set up that for every exception when it is created,
     * it will be logged immediatelly into the logs.
     *
     * @param string          $message  human-readable error message
     * @param int             $code     numeric error code (often HTTP status)
     * @param \Throwable|null $previous previous throwable for exception chaining
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
        EventLogger::getInstance()->log($message ?: 'An error occurred.');
    }
}
