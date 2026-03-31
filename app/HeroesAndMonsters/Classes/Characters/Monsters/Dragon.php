<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\Characters\Monsters;

class Dragon extends Monster {

    protected int $health = 50;

    /** @var array{attackType: string, damage: int} */
    public array $attack1 = [
        'attackType' => 'Fire Breath', 
        'damage' => 20
    ];

    /** @var array{attackType: string, damage: int} */
    public array $attack2 = [
        'attackType' => 'Hitting',
        'damage' => 5
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

        if ($attackType === 1) {
            return $this->attack1;
        } else {
            return $this->attack2;
        }
    }

}