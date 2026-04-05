<?php

declare(strict_types=1);

namespace Tests\Domain\HeroesAndMonsters\Classes\Characters\Heroes;

use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Warrior;
use Domain\HeroesAndMonsters\Classes\GameObjects\Lance;
use Domain\HeroesAndMonsters\Classes\GameObjects\Sword;
use PHPUnit\Framework\TestCase;

class WarriorTest extends TestCase
{
    private Warrior $warrior;
    private Sword $sword;
    private Lance $lance;

    protected function setUp(): void
    {
        $this->warrior = new Warrior();
        $this->sword = new Sword();
        $this->lance = new Lance();
    }

    public function testWarriorCreated(): void
    {
        $this->assertInstanceOf(Warrior::class, $this->warrior);
    }

    public function testPickUpWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertContains($this->sword, $bag->getWeapons());
    }

    public function testThirdWeaponPickUp(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->pickUpWeapon($this->lance);
        $this->warrior->pickUpWeapon(new Sword());
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertCount(2, $bag->getWeapons());
    }

    public function testDropWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->lance);
        $dropped = $this->warrior->dropWeapon();
        $this->assertInstanceOf(Lance::class, $dropped);
    }

    public function testShowAllWeaponsEmptyBag(): void
    {
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertEmpty($bag->getWeapons());
    }

    public function testShowAllWeaponsWhenHasSword(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertContains($this->sword, $bag->getWeapons());
    }

    public function testShowActiveWeaponButNoWeapon(): void
    {
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertNull($bag->getActiveWeapon());
    }

    public function testShowActiveWeaponWithWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertEquals($this->sword, $bag->getActiveWeapon());
    }

    public function testSwitchWeaponWhenNoWeapons(): void
    {
        $this->warrior->switchWeapon();
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertNull($bag->getActiveWeapon());
    }

    public function testSwitchWeaponWhenOneWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->switchWeapon();
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertEquals($this->sword, $bag->getActiveWeapon());
    }

    public function testSwitchWeaponSuccessfully(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->pickUpWeapon($this->lance);
        $this->warrior->switchWeapon();
        $bag = $this->getWeaponBag($this->warrior);
        $this->assertEquals($this->lance, $bag->getActiveWeapon());
    }

    private function getWeaponBag(Warrior $warrior): \Domain\HeroesAndMonsters\Classes\GameObjects\WeaponBag
    {
        $ref = new \ReflectionClass($warrior);
        $prop = $ref->getProperty('weaponBag');
        $prop->setAccessible(true);

        return $prop->getValue($warrior);
    }

    public function testGetAttackTypeWhenUnarmed(): void
    {
        $attackType = $this->warrior->getAttackType();
        $expectedArray = [
            'attackType' => 'Unarmed',
            'damage' => 1,
        ];
        $this->assertEquals($expectedArray, $attackType);
    }

    public function testGetAttackTypeWithWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $attackType = $this->warrior->getAttackType();
        $expectedArray = [
            'attackType' => 'Sword',
            'damage' => $this->sword->getDamage(),
        ];
        $this->assertEquals($expectedArray, $attackType);
    }
}