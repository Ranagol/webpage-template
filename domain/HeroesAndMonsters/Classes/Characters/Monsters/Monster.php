<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\Characters\Monsters;

use Domain\HeroesAndMonsters\Classes\Characters\Character;

/**
 * All Dragons and Spider must be childs of the Monster class.
 */
abstract class Monster extends Character
{
    protected int $health;

    /**
     * This will be used for all Monsters, to decide whether they will use attack1 or attack2.
     */
    protected function randomGenerator(): int
    {
        return rand(1, 2);
    }

    /**
     * @return array{attackType: string, damage: int}
     */
    abstract public function getAttackType(): array;
}