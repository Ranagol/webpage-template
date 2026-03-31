<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Exceptions;

class NoWeaponException extends BaseException
{
    public function __construct(
        string $message = 'No weapon found for this hero, in his bag!',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
