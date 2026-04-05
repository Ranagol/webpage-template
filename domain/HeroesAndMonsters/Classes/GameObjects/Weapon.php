<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\GameObjects;

namespace Domain\HeroesAndMonsters\Classes\GameObjects;

abstract class Weapon extends GameObject
{
    public function getWeaponClassName(): string
    {
        return $this->getClassName();
    }

    abstract public function getDamage(): int;
}
