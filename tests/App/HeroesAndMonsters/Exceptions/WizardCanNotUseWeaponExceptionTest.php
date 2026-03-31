<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Exceptions\WizardCanNotUseWeaponException;
use PHPUnit\Framework\TestCase;

class WizardCanNotUseWeaponExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $e = new WizardCanNotUseWeaponException();
        $this->assertStringContainsString('Wizards can not use weapons', $e->getMessage());
    }
}
