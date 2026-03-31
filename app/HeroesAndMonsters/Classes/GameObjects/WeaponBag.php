<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\GameObjects;

use App\HeroesAndMonsters\Exceptions\CantSwitchOneWeaponException;
use App\HeroesAndMonsters\Exceptions\MaxWeaponNrExceededException;
use App\HeroesAndMonsters\Exceptions\NoWeaponException;

/**
 * All Heroes have a WeaponBag. They can store here max 2 weapons.
 * Sidenote: Wizzard is not able to pick up weapons.
 */
class WeaponBag extends GameObject {

    /**
     * @var Weapon[]
     */
    public array $weapons = [];

    private int $activeWeaponIndex = 0;

    private int $maxNumberOfWeapons = 2;

    public function __construct()
    {
        //this is deliberatly empty, we don't want to log every WeaponBag creation
    }

    /**
     * Adds a weapon to the bag.
     * 
     * @throws MaxWeaponNrExceededException
     * @param Weapon $weapon
     * @return void
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
     * @return Weapon
     * @throws NoWeaponException
     */
    public function removeActiveWeapon(): Weapon
    {
        if (count($this->weapons) == 0) {
            throw new NoWeaponException();
        }

        //Get the active weapon
        $activeWeapon = $this->weapons[$this->activeWeaponIndex];

        //Remove the active weapon from the weapons array
        array_splice($this->weapons, $this->activeWeaponIndex, 1);

        return $activeWeapon;

    }

    /**
     * Returns active weapon or null (if there is no weapon in WeaponBag)
     *
     * @return Weapon | null
     */
    public function getActiveWeapon(): Weapon | null 
    {
        if (count($this->weapons) == 0) {
            return null;
        }
    
        return $this->weapons[$this->activeWeaponIndex];
    }

    /**
     * Hero can with this function switch to the next weapon in the bag.
     * 
     * @throws NoWeaponException
     * @throws CantSwitchOneWeaponException
     * @return void
     */
    public function switchWeapon(): void 
    {
        if (count($this->weapons) == 0) {
            throw new NoWeaponException();
        }

        if(count($this->weapons) == 1) {
            throw new CantSwitchOneWeaponException();
        }
        
        /**
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

