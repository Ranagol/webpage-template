<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\GameObjects\Sword;
use PHPUnit\Framework\TestCase;

class SwordTest extends TestCase
{
    public function testSwordDamage(): void
    {
        $sword = new Sword();
        $this->assertEquals(20, $sword->getDamage());
    }

    public function testSwordClassName(): void
    {
        $sword = new Sword();
        $this->assertEquals('Sword', $sword->getClassName());
    }

    public function testSwordIsWeapon(): void
    {
        $sword = new Sword();
        $this->assertInstanceOf(App\HeroesAndMonsters\Classes\GameObjects\Weapon::class, $sword);
    }
}
