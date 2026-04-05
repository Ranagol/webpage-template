<?php

declare(strict_types=1);

namespace Tests\Domain\HeroesAndMonsters\Classes\GameObjects;

use Domain\HeroesAndMonsters\Classes\GameObjects\Lance;
use Domain\HeroesAndMonsters\Classes\GameObjects\Sword;
use Domain\HeroesAndMonsters\Classes\GameObjects\WeaponBag;
use Domain\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException;
use Domain\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use Domain\HeroesAndMonsters\Exceptions\NoWeaponException;
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
        $this->expectException(MaxWeaponNrExceededException::class);
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
        $this->expectException(NoWeaponException::class);
        $bag->removeActiveWeapon();
    }

    public function testSwitchWeaponThrowsIfEmpty(): void
    {
        $bag = new WeaponBag();
        $this->expectException(NoWeaponException::class);
        $bag->switchWeapon();
    }

    public function testSwitchWeaponThrowsIfOne(): void
    {
        $bag = new WeaponBag();
        $bag->addWeapon(new Sword());
        $this->expectException(CantSwitchOneWeaponException::class);
        $bag->switchWeapon();
    }

    public function testSwitchWeaponSwaps(): void
    {
        $bag = new WeaponBag();
        $sword = new Sword();
        $lance = new Lance();
        $bag->addWeapon($sword);
        $bag->addWeapon($lance);
        $this->assertSame($sword, $bag->getActiveWeapon());
        $bag->switchWeapon();
        $this->assertSame($lance, $bag->getActiveWeapon());
    }
}