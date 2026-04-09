<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Exceptions;

class CantSwitchOneWeaponException extends BaseException
{
    public function __construct(
        string $message = "Can't switch weapon: only one weapon in bag!",
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
