<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\GameObjects;

use App\HeroesAndMonsters\Classes\GameObjects\Weapon;

class Lance extends Weapon {

    private int $damage = 15;

    public function getDamage(): int
    {
        return $this->damage;
    }

}