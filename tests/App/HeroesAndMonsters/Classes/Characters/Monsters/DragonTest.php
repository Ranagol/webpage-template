<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\Characters\Monsters\Dragon;
use PHPUnit\Framework\TestCase;

class DragonTest extends TestCase
{
    public function testDragonHealth(): void
    {
        $dragon = new Dragon();
        $this->assertEquals(50, $dragon->getHealth());
    }

    public function testDragonAttackTypeFireBreath(): void
    {
        $dragon = $this->getMockBuilder(Dragon::class)
            ->onlyMethods(['randomGenerator'])
            ->getMock();
        $dragon->method('randomGenerator')->willReturn(1);
        $attack = $dragon->getAttackType();
        $this->assertEquals('Fire Breath', $attack['attackType']);
        $this->assertEquals(30, $attack['damage']);
    }

    public function testDragonAttackTypeHitting(): void
    {
        $dragon = $this->getMockBuilder(Dragon::class)
            ->onlyMethods(['randomGenerator'])
            ->getMock();
        $dragon->method('randomGenerator')->willReturn(2);
        $attack = $dragon->getAttackType();
        $this->assertEquals('Hitting', $attack['attackType']);
        $this->assertEquals(20, $attack['damage']);
    }

    public function testIsMonster(): void
    {
        $dragon = new Dragon();
        $this->assertInstanceOf(App\HeroesAndMonsters\Classes\Characters\Monsters\Monster::class, $dragon);
    }
}
