<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Exceptions;

use App\HeroesAndMonsters\Exceptions\BaseException;

class WeaponForbiddenForWizardException extends BaseException
{
    public function __construct(
        string $message = "Weapon is forbidden for wizard heroes!",
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}