<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\Characters\Monsters;

namespace Domain\HeroesAndMonsters\Classes\Characters\Monsters;

class Spider extends Monster
{
    protected int $health = 50;

    /** @var array{attackType: string, damage: int} */
    public array $attack1 = [
        'attackType' => 'Biting',
        'damage' => 20,
    ];

    /** @var array{attackType: string, damage: int} */
    public array $attack2 = [
        'attackType' => 'Hitting',
        'damage' => 15,
    ];

    /**
     * Every character, when attacks, must return an array with attackType and damage.
     *
     * @return array{
     *   attackType: string,
     *   damage: int
     *  }
     */
    public function getAttackType(): array
    {
        $attackType = $this->randomGenerator();

        if (1 === $attackType) {
            return $this->attack1;
        }

        return $this->attack2;

    }
}
