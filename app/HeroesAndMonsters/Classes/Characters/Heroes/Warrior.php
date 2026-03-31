<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\Characters\Heroes;

use App\HeroesAndMonsters\Exceptions\NoWeaponException;
use App\HeroesAndMonsters\Classes\Characters\Heroes\Hero;
use App\HeroesAndMonsters\Classes\GameObjects\Weapon;
use App\HeroesAndMonsters\Classes\GameObjects\WeaponBag;
use App\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException;
use App\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use App\HeroesAndMonsters\Logs\Logger;

class Warrior extends Hero {

    protected int $health = 100;

    private string|null $heroClassName = null;

    private WeaponBag $weaponBag;

    public function __construct()
    {
        parent::__construct();
        $this->weaponBag = new WeaponBag();
        $this->heroClassName = $this->getClassName();
    }

    public function pickUpWeapon(Weapon $weapon): void
    {
        try {
            $this->weaponBag->addWeapon($weapon);
            $heroClassName = $this->getClassName();
            $weaponName = $weapon->getWeaponClassName();
            Logger::getInstance()->log($heroClassName . " picked up a " . $weaponName);
        } catch (MaxWeaponNrExceededException $e) {
            Logger::getInstance()->log("Cannot pick up weapon: bag is full!");
        }
    }

    public function dropWeapon(): Weapon|null
    {
        try {
            $removedActiveWeapon = $this->weaponBag->removeActiveWeapon();
            Logger::getInstance()->log($this->heroClassName . " dropped his " . $removedActiveWeapon->getWeaponClassName());
            return $removedActiveWeapon;
        } catch (\Throwable $th) {
            Logger::getInstance()->log($this->heroClassName . " cannot drop weapon: no weapons in the bag.");
            return null;
        }
    }

    public function showAllWeapons(): void
    {
        $allWeapons = $this->weaponBag->getWeapons();
        if (count($allWeapons) == 0) {
            Logger::getInstance()->log($this->heroClassName . " has no weapons in the bag.");
            return;
        }
        foreach ($allWeapons as $weapon) {
            $weaponName = $weapon->getWeaponClassName();
            Logger::getInstance()->log($this->heroClassName . " has a " . $weaponName . " in the bag.");
        }
    }

    public function showActiveWeapon(): void
    {
        $activeWeapon = $this->weaponBag->getActiveWeapon();
        if (!$activeWeapon) {
            Logger::getInstance()->log($this->heroClassName . " has no active weapon.");
            return;
        }
        $weaponName = $activeWeapon->getWeaponClassName();
        Logger::getInstance()->log($this->heroClassName . "'s active weapon is a " . $weaponName);
    }

    /**
     * Warrior can swith active weapon to another weapon, ih he has two weapons in his WeaponBag.
     *
     * @return void
     */
    public function switchWeapon(): void
    {
        try {
            $this->weaponBag->switchWeapon();
            Logger::getInstance()->log($this->heroClassName . " switched weapon.");
        } catch (NoWeaponException $e) {
            Logger::getInstance()->log($this->heroClassName . " cannot switch weapon: no weapons in the bag.");
            return;
        } catch (CantSwitchOneWeaponException $e) {
            Logger::getInstance()->log($this->heroClassName . " cannot switch weapon: only one weapon in the bag.");
            return;
        }
    }

    /**
     * Every character, when attacks, must return an array with attackType and damage.
     * This is how the app knows what type of attack it is and how much damage to apply to the opponent.
     *
     * @return array{
     *   attackType: string,
     *   damage: int
     *  }
     */
    public function getAttackType(): array
    {
        $activeWeapon = $this->weaponBag->getActiveWeapon();
        if (!$activeWeapon) {
            return [
                'attackType' => 'Unarmed',
                'damage' => 1
            ];
        } else {
            $attackType = $activeWeapon->getClassName();
            $damage = $activeWeapon->getDamage();
            return [
                'attackType' => $attackType,
                'damage' => $damage
            ];
        }
    }
}



