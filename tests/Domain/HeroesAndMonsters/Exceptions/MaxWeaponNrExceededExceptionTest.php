<?php

declare(strict_types=1);

namespace Tests\Domain\HeroesAndMonsters\Exceptions;

use Domain\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use PHPUnit\Framework\TestCase;

class MaxWeaponNrExceededExceptionTest extends TestCase
{
    //TODO ANDOR HORRIBLE TEST, REWRITE
    public function testExceptionMessage(): void
    {
        $e = new MaxWeaponNrExceededException();
        $this->assertStringContainsString('Maximum number of weapons', $e->getMessage());
    }
}