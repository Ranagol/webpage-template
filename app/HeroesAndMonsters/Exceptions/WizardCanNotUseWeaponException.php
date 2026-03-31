<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Exceptions;

use Exception;

class WizardCanNotUseWeaponException extends Exception
{
    public function __construct(
        string $message = "Wizards can not use weapons!",
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}