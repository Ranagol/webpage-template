<?php

declare(strict_types=1);

namespace Tests\Unit\Classes\Characters\Heroes;

use App\HeroesAndMonsters\Classes\Characters\Heroes\Warrior;
use App\HeroesAndMonsters\Classes\GameObjects\Lance;
use App\HeroesAndMonsters\Classes\GameObjects\Sword;
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
        $this->assertTrue(true); // No output check, just ensure no exception
    }

    public function testThirdWeaponPickUp(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->pickUpWeapon($this->lance);
        // Should not throw, just log internally
        $this->warrior->pickUpWeapon(new Sword());
        $this->assertTrue(true);
    }

    public function testDropWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->lance);
        $dropped = $this->warrior->dropWeapon();
        $this->assertInstanceOf(Lance::class, $dropped);
    }

    public function testShowAllWeaponsEmptyBag(): void
    {
        $this->warrior->showAllWeapons();
        $this->assertTrue(true);
    }

    public function testShowAllWeaponsWhenHasSword(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->showAllWeapons();
        $this->assertTrue(true);
    }

    public function testShowActiveWeaponButNoWeapon(): void
    {
        $this->warrior->showActiveWeapon();
        $this->assertTrue(true);
    }

    public function testShowActiveWeaponWithWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->showActiveWeapon();
        $this->assertTrue(true);
    }

    public function testSwitchWeaponWhenNoWeapons(): void
    {
        $this->warrior->switchWeapon();
        $this->assertTrue(true);
    }

    public function testSwitchWeaponWhenOneWeapon(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->switchWeapon();
        $this->assertTrue(true);
    }

    public function testSwitchWeaponSuccessfully(): void
    {
        $this->warrior->pickUpWeapon($this->sword);
        $this->warrior->pickUpWeapon($this->lance);
        $this->warrior->switchWeapon();
        $this->assertTrue(true);
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
