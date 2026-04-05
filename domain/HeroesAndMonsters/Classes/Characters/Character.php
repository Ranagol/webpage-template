<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\Characters;

use Domain\HeroesAndMonsters\Classes\GameObjects\GameObject;

/**
 * Characters can be Heroes and Monsters (living beings, not objects).
 */
class Character extends GameObject
{
    protected int $health;

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    public function decreaseHealth(int $amount): void
    {
        $this->health -= $amount;
    }

    public function isAlive(): bool
    {
        return $this->health > 0;
    }
}
