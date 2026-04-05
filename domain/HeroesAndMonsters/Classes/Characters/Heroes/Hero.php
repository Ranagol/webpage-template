<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\Characters\Heroes;

use Domain\HeroesAndMonsters\Classes\Characters\Character;
use Domain\HeroesAndMonsters\Classes\GameObjects\Weapon;

/**
 * All Warriors and Wizards must extend this class, and must have these abstract methods.
 */
abstract class Hero extends Character
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array{attackType: string, damage: int}
     */
    abstract public function getAttackType(): array;

    abstract public function pickUpWeapon(Weapon $weapon): void;
}
