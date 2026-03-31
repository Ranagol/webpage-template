<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException;
use PHPUnit\Framework\TestCase;

class CantSwitchOneWeaponExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $e = new CantSwitchOneWeaponException();
        $this->assertStringContainsString('only one weapon', $e->getMessage());
    }
}
