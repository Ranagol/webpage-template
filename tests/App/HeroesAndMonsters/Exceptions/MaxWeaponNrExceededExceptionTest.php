<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use PHPUnit\Framework\TestCase;

class MaxWeaponNrExceededExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $e = new MaxWeaponNrExceededException();
        $this->assertStringContainsString('Maximum number of weapons', $e->getMessage());
    }
}
