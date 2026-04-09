<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes;

use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Hero;
use Domain\HeroesAndMonsters\Classes\Characters\Monsters\Monster;
use Domain\HeroesAndMonsters\Logs\EventLogger;

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
        EventLogger::getInstance()->log('The fight begins between '
            . $this->hero->getClassName()
            . ' and '
            . $this->monster->getClassName()
            . '!' . $this->displayHealthPoints());

        while ($this->hero->isAlive() && $this->monster->isAlive()) {

            $attacker = $this->whoWillAttack();

            if ($attacker instanceof Hero) {
                $this->attack($this->hero, $this->monster);
            } else {
                $this->attack($this->monster, $this->hero);
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

    private function attack(Hero|Monster $attacker, Hero|Monster $defender): void
    {
        $attack = $attacker->getAttackType();
        $attackType = $attack['attackType'];
        $damage = $attack['damage'];
        $defender->decreaseHealth($damage);

        EventLogger::getInstance()->log(
            $attacker->getClassName()
            . ' used '
            . $attackType
            . ' and caused '
            . $damage
            . ' damage to '
            . $defender->getClassName()
            . '.'
            . $this->displayHealthPoints()
        );
    }

    /**
     * Displays like:
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

            EventLogger::getInstance()->log(
                $this->hero->getClassName()
                . ' defeated '
                . $this->monster->getClassName()
                . '!'
            );
        } else {
            EventLogger::getInstance()->log(
                $this->monster->getClassName()
                . ' defeated '
                . $this->hero->getClassName()
                . '!'
            );
        }

        EventLogger::getInstance()->log('The fight has ended.');
    }
}
