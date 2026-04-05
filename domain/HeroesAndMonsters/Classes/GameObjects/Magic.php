<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\GameObjects;
namespace Domain\HeroesAndMonsters\Classes\GameObjects;

class Magic extends GameObject
{
    private int $damage = 30;

    public function getDamage(): int
    {
        return $this->damage;
    }
}
