<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes;

use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Hero;
use Domain\HeroesAndMonsters\Classes\Characters\Monsters\Monster;
use Domain\HeroesAndMonsters\Logs\Logger;

/**
 * This class manages the fight between a Hero and a Monster. The fight lasts, till the Hero or Monster
 * Health point doesn't sink to zero. In every round a random generator decides who can attack.
 */
class FightManager
{
    private Hero $hero;

    private Monster $monster;

    public function __construct(Hero $hero, Monster $monster)
    {
        $this->hero = $hero;
        $this->monster = $monster;
    }

    public function fight(): void
    {
        Logger::getInstance()->log('The fight begins between '
            . $this->hero->getClassName()
            . ' and '
            . $this->monster->getClassName()
            . '!' . $this->displayHealthPoints());

        while ($this->hero->isAlive() && $this->monster->isAlive()) {

            $attacker = $this->whoWillAttack();

            if ($attacker instanceof Hero) {
                $this->heroAttacks();
            } else {
                $this->monsterAttacks();
            }
        }
        $this->announceWinner();
    }

    /**
     * Decides randomly, who can attack in the given round, the Hero or the Monster.
     */
    private function whoWillAttack(): Hero|Monster
    {
        // Get random number between 0 and 100
        $randomNumber = rand(0, 100);

        if ($randomNumber <= 50) {
            return $this->hero;
        }

        return $this->monster;

    }

    private function heroAttacks(): void
    {
        $heroAttack = $this->hero->getAttackType();
        $attackType = $heroAttack['attackType'];
        $damage = $heroAttack['damage'];
        $this->monster->decreaseHealth($damage);
        Logger::getInstance()->log(
            $this->hero->getClassName()
            . ' used '
            . $attackType
            . ' and caused '
            . $damage
            . ' damage to '
            . $this->monster->getClassName()
            . '.'
            . $this->displayHealthPoints()
        );
    }

    private function monsterAttacks(): void
    {
        $monsterAttack = $this->monster->getAttackType();
        $attackType = $monsterAttack['attackType'];
        $damage = $monsterAttack['damage'];
        $this->hero->decreaseHealth($damage);
        Logger::getInstance()->log(
            $this->monster->getClassName()
            . ' used '
            . $attackType
            . ' and caused '
            . $damage
            . ' damage to '
            . $this->hero->getClassName()
            . '.'
            . $this->displayHealthPoints()
        );
    }

    /**
     * Warrior HP: 100 - Dragon HP: 120.
     */
    private function displayHealthPoints(): string
    {
        return ' '
            . $this->hero->getClassName()
            . ' HP: '
            . $this->hero->getHealth()
            . ' - '
            . $this->monster->getClassName()
            . ' HP: '
            . $this->monster->getHealth()
            . '.';

    }

    /**
     * When the fight is over, this function announces who is the winner.
     */
    private function announceWinner(): void
    {
        if ($this->hero->isAlive()) {

            Logger::getInstance()->log(
                $this->hero->getClassName()
                . ' defeated '
                . $this->monster->getClassName()
                . '!'
            );
        } else {
            Logger::getInstance()->log(
                $this->monster->getClassName()
                . ' defeated '
                . $this->hero->getClassName()
                . '!'
            );
        }

        Logger::getInstance()->log('The fight has ended.');
    }
}