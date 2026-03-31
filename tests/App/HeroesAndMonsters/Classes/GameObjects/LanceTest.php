<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\GameObjects\Lance;
use PHPUnit\Framework\TestCase;

class LanceTest extends TestCase
{
    public function testLanceDamage(): void
    {
        $lance = new Lance();
        $this->assertEquals(25, $lance->getDamage());
    }

    public function testLanceClassName(): void
    {
        $lance = new Lance();
        $this->assertEquals('Lance', $lance->getClassName());
    }

    public function testLanceIsWeapon(): void
    {
        $lance = new Lance();
        $this->assertInstanceOf(App\HeroesAndMonsters\Classes\GameObjects\Weapon::class, $lance);
    }
}
