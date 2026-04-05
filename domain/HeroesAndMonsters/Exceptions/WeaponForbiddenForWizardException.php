<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Exceptions;

namespace Domain\HeroesAndMonsters\Exceptions;

class WeaponForbiddenForWizardException extends BaseException
{
    public function __construct(
        string $message = 'Weapon is forbidden for wizard heroes!',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
