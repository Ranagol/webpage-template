<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\GameObjects\Sword;
use App\HeroesAndMonsters\Classes\GameObjects\WeaponBag;
use PHPUnit\Framework\TestCase;

class WeaponBagTest extends TestCase
{
    public function testAddAndGetWeapons(): void
    {
        $bag = new WeaponBag();
        $sword = new Sword();
        $bag->addWeapon($sword);
        $this->assertCount(1, $bag->getWeapons());
        $this->assertSame($sword, $bag->getWeapons()[0]);
    }

    public function testAddMoreThanMaxThrows(): void
    {
        $bag = new WeaponBag();
        $bag->addWeapon(new Sword());
        $bag->addWeapon(new Sword());
        $this->expectException(App\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException::class);
        $bag->addWeapon(new Sword());
    }

    public function testRemoveActiveWeapon(): void
    {
        $bag = new WeaponBag();
        $sword = new Sword();
        $bag->addWeapon($sword);
        $removed = $bag->removeActiveWeapon();
        $this->assertSame($sword, $removed);
        $this->assertCount(0, $bag->getWeapons());
    }

    public function testRemoveActiveWeaponThrowsIfEmpty(): void
    {
        $bag = new WeaponBag();
        $this->expectException(App\HeroesAndMonsters\Exceptions\NoWeaponException::class);
        $bag->removeActiveWeapon();
    }

    public function testSwitchWeaponThrowsIfEmpty(): void
    {
        $bag = new WeaponBag();
        $this->expectException(App\HeroesAndMonsters\Exceptions\NoWeaponException::class);
        $bag->switchWeapon();
    }

    public function testSwitchWeaponThrowsIfOne(): void
    {
        $bag = new WeaponBag();
        $bag->addWeapon(new Sword());
        $this->expectException(App\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException::class);
        $bag->switchWeapon();
    }

    public function testSwitchWeaponSwaps(): void
    {
        $bag = new WeaponBag();
        $sword = new Sword();
        $lance = new App\HeroesAndMonsters\Classes\GameObjects\Lance();
        $bag->addWeapon($sword);
        $bag->addWeapon($lance);
        $this->assertSame($sword, $bag->getActiveWeapon());
        $bag->switchWeapon();
        $this->assertSame($lance, $bag->getActiveWeapon());
    }
}
