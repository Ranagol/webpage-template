<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\GameObjects;

class Lance extends Weapon
{
    private int $damage = 25;

    public function getDamage(): int
    {
        return $this->damage;
    }
}
