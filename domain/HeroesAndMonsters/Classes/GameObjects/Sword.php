<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\GameObjects;

namespace Domain\HeroesAndMonsters\Classes\GameObjects;

class Sword extends Weapon
{
    private int $damage = 20;

    public function getDamage(): int
    {
        return $this->damage;
    }
}
