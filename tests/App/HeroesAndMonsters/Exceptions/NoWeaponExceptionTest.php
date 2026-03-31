<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Exceptions\NoWeaponException;
use PHPUnit\Framework\TestCase;

class NoWeaponExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $e = new NoWeaponException();
        $this->assertStringContainsString('No weapon found', $e->getMessage());
    }
}
