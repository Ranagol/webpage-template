<?php

declare(strict_types=1);

namespace App\Controllers;

use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Warrior;
use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Wizard;
use Domain\HeroesAndMonsters\Classes\Characters\Monsters\Dragon;
use Domain\HeroesAndMonsters\Classes\Characters\Monsters\Spider;
use Domain\HeroesAndMonsters\Classes\FightManager;
use Domain\HeroesAndMonsters\Classes\GameObjects\Lance;
use Domain\HeroesAndMonsters\Classes\GameObjects\Magic;
use Domain\HeroesAndMonsters\Classes\GameObjects\Sword;
use Domain\HeroesAndMonsters\Logs\Logger;

class HeroesAndMonstersController extends Controller
{
    /**
     * Displays the Heroes and Monsters page. Without the fight event demonstration. This is the
     * default.
     */
    public function heroesAndMonsters(): void
    {
        // Always pass $events (empty array) to avoid undefined variable in view
        $this->view(
            'heroesAndMonsters',
            [
                'events' => [],
            ]
        );
    }

    /**
     * Displays the Heroes and Monsters page, with the fight event demonstration.
     */
    public function demonstrate(): void
    {
        $events = $this->startHeroesAndMonsters();
        $this->view(
            'heroesAndMonsters',
            [
                'events' => $events,
            ]
        );
    }

    /**
     * This is where everything happens regarding the heroes and monster. This is where we set up
     * all the actions, or the fights.
     */
    /**
     * @return string[]
     */
    private function startHeroesAndMonsters(): array
    {
        Logger::getInstance()->log('Game started!');

        /**
         * creating characters and game objects.
         */
        // Logger::getInstance()->log('Creating characters and game objects');
        $warrior = new Warrior();
        $wizard = new Wizard();

        $sword = new Sword();
        $lance = new Lance();
        $magic = new Magic();
        // $sword2 = new Sword();

        $dragon = new Dragon();
        $spider = new Spider();

        /*
         * Warrior actions: picking up weapons, showing active weapon, switching weapon, dropping weapon
         */
        // Logger::getInstance()->log('Warrior actions');
        $warrior->pickUpWeapon($sword);
        $warrior->pickUpWeapon($lance);
        $warrior->showActiveWeapon();
        $warrior->switchWeapon();
        // $warrior->showActiveWeapon();
        // $warrior->switchWeapon();
        // $warrior->showActiveWeapon();
        // $warrior->showAllWeapons();

        $droppedWeapon = $warrior->dropWeapon();
        $warrior->showAllWeapons();

        /*
         * Wizard learns new magic
         */
        // Logger::getInstance()->log('Wizard actions');
        $wizard->learnMagic($magic);
        $wizard->pickUpWeapon($sword);

        /**
         * Fight 1.
         */
        $fightManager = new FightManager($wizard, $spider);
        $fightManager->fight();

        /**
         * Fight 2.
         */
        $fightManager = new FightManager($warrior, $dragon);
        $fightManager->fight();

        Logger::getInstance()->log('Game ended.');
        Logger::getInstance()->log('Feel free to check out in the source code the php classes like the Warrior and the Dragon. :)');
        $events = Logger::getInstance()->getEvents();

        return $events;
    }
}
