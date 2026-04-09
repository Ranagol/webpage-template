<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Exceptions;

class WizardCanNotUseWeaponException extends BaseException
{
    public function __construct(
        string $message = 'Wizards can not use weapons!',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
