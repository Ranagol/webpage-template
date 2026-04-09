<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\GameObjects;

use Domain\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException;
use Domain\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use Domain\HeroesAndMonsters\Exceptions\NoWeaponException;

/**
 * All Heroes have a WeaponBag. They can store here max 2 weapons.
 * Sidenote: Wizzard is not able to pick up weapons.
 */
class WeaponBag extends GameObject
{
    /**
     * @var Weapon[]
     */
    public array $weapons = [];

    private int $activeWeaponIndex = 0;

    private int $maxNumberOfWeapons = 2;

    public function __construct()
    {
        parent::__construct(true); // Suppress logging for WeaponBag
    }

    /**
     * Adds a weapon to the bag.
     *
     * @throws MaxWeaponNrExceededException
     */
    public function addWeapon(Weapon $weapon): void
    {
        if (count($this->weapons) < $this->maxNumberOfWeapons) {
            $this->weapons[] = $weapon;
        } else {
            throw new MaxWeaponNrExceededException();
        }
    }

    /**
     * Removes and returns the active weapon from the bag.
     *
     * @throws NoWeaponException
     */
    public function removeActiveWeapon(): Weapon
    {
        if (0 == count($this->weapons)) {
            throw new NoWeaponException();
        }

        // Get the active weapon
        $activeWeapon = $this->weapons[$this->activeWeaponIndex];

        // Remove the active weapon from the weapons array
        array_splice($this->weapons, $this->activeWeaponIndex, 1);

        return $activeWeapon;

    }

    /**
     * Returns active weapon or null (if there is no weapon in WeaponBag).
     */
    public function getActiveWeapon(): ?Weapon
    {
        if (0 == count($this->weapons)) {
            return null;
        }

        return $this->weapons[$this->activeWeaponIndex];
    }

    /**
     * Hero can with this function switch to the next weapon in the bag.
     *
     * @throws NoWeaponException
     * @throws CantSwitchOneWeaponException
     */
    public function switchWeapon(): void
    {
        if (0 == count($this->weapons)) {
            throw new NoWeaponException();
        }

        if (1 == count($this->weapons)) {
            throw new CantSwitchOneWeaponException();
        }

        /*
         * This will reverse items in array. ['apple', 'orange'] will become ['orange', 'apple']
         * We need to do this, because the active weapon is always at index 0 in the weapons array.
         */
        $this->weapons = array_reverse($this->weapons);
    }

    /**
     * Returns all weapons in the bag.
     *
     * @return Weapon[]
     */
    public function getWeapons(): array
    {
        return $this->weapons;
    }
}
