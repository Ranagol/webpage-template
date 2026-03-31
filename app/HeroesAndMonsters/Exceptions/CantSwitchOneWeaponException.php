<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Exceptions;

use App\HeroesAndMonsters\Exceptions\BaseException;

class CantSwitchOneWeaponException extends BaseException
{
    public function __construct(
        string $message = "Can't switch weapon: only one weapon in bag!",
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}