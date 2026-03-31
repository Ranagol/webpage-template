<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\GameObjects;

use App\HeroesAndMonsters\Classes\GameObjects\Weapon;

class Sword extends Weapon {

    private int $damage = 10;

    public function getDamage(): int
    {
        return $this->damage;
    }

}