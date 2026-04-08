<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\Characters\Heroes;

use Domain\HeroesAndMonsters\Classes\GameObjects\Weapon;
use Domain\HeroesAndMonsters\Classes\GameObjects\WeaponBag;
use Domain\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException;
use Domain\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use Domain\HeroesAndMonsters\Exceptions\NoWeaponException;
use Domain\HeroesAndMonsters\Logs\EventLogger;

class Warrior extends Hero
{
    protected int $health = 50;

    private ?string $heroClassName = null;

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
            EventLogger::getInstance()->log($heroClassName . ' picked up a ' . $weaponName . '.');
        } catch (MaxWeaponNrExceededException $e) {
            EventLogger::getInstance()->log('Cannot pick up weapon: bag is full!');
        }
    }

    public function dropWeapon(): ?Weapon
    {
        try {
            $removedActiveWeapon = $this->weaponBag->removeActiveWeapon();
            EventLogger::getInstance()->log($this->heroClassName . ' dropped his ' . $removedActiveWeapon->getWeaponClassName() . '.');

            return $removedActiveWeapon;
        } catch (\Throwable $th) {
            EventLogger::getInstance()->log($this->heroClassName . ' cannot drop weapon: no weapons in the bag.');

            return null;
        }
    }

    public function showAllWeapons(): void
    {
        $allWeapons = $this->weaponBag->getWeapons();
        if (count($allWeapons) === 0) {
            EventLogger::getInstance()->log($this->heroClassName . ' has no weapons in the bag.');

            return;
        }
        foreach ($allWeapons as $weapon) {
            $weaponName = $weapon->getWeaponClassName();
            EventLogger::getInstance()->log($this->heroClassName . ' has a ' . $weaponName . ' in the bag.');
        }
    }

    public function showActiveWeapon(): void
    {
        $activeWeapon = $this->weaponBag->getActiveWeapon();
        if (!$activeWeapon) {
            EventLogger::getInstance()->log($this->heroClassName . ' has no active weapon.');

            return;
        }
        $weaponName = $activeWeapon->getWeaponClassName();
        EventLogger::getInstance()->log($this->heroClassName . "'s active weapon is a " . $weaponName . '.');
    }

    /**
     * Warrior can swith active weapon to another weapon, ih he has two weapons in his WeaponBag.
     */
    public function switchWeapon(): void
    {
        try {
            $this->weaponBag->switchWeapon();
            EventLogger::getInstance()->log($this->heroClassName . ' switched weapon.');
        } catch (NoWeaponException $e) {
            EventLogger::getInstance()->log($this->heroClassName . ' cannot switch weapon: no weapons in the bag.');

            return;
        } catch (CantSwitchOneWeaponException $e) {
            EventLogger::getInstance()->log($this->heroClassName . ' cannot switch weapon: only one weapon in the bag.');

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
                'damage' => 1,
            ];
        }
        $attackType = $activeWeapon->getClassName();
        $damage = $activeWeapon->getDamage();

        return [
            'attackType' => $attackType,
            'damage' => $damage,
        ];

    }
}
