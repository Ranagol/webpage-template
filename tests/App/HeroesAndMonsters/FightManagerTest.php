<?php

declare(strict_types=1);

namespace Tests\Unit\Classes;

use App\HeroesAndMonsters\Classes\Characters\Heroes\Warrior;
use App\HeroesAndMonsters\Classes\Characters\Monsters\Dragon;
use App\HeroesAndMonsters\Classes\FightManager;
use PHPUnit\Framework\TestCase;

class FightManagerTest extends TestCase
{
    public function testFight(): void
    {
        $warrior = new Warrior();
        $dragon = new Dragon();
        $fightManager = new FightManager($warrior, $dragon);

        // Check if both the warrior or the dragon are alive before the fight
        $this->assertTrue($warrior->isAlive() && $dragon->isAlive());

        $fightManager->fight();

        // Check if either the warrior or the dragon is dead at the end of the fight
        $this->assertTrue(!$warrior->isAlive() || !$dragon->isAlive());
    }
}
