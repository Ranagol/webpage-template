<?php

declare(strict_types=1);

namespace Tests\Domain\HeroesAndMonsters\Exceptions;

use Domain\HeroesAndMonsters\Exceptions\NoWeaponException;
use PHPUnit\Framework\TestCase;

class NoWeaponExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        //TODO ANDOR HORRIBLE TEST, REWRITE
        $e = new NoWeaponException();
        $this->assertStringContainsString('No weapon found', $e->getMessage());
    }
}