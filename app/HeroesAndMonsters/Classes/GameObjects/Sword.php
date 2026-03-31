<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\GameObjects;

class Sword extends Weapon
{
    private int $damage = 20;

    public function getDamage(): int
    {
        return $this->damage;
    }
}
