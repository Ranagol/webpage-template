<?php

declare(strict_types=1);

namespace App\Controllers;

use App\HeroesAndMonsters\Classes\Characters\Heroes\Warrior;
use App\HeroesAndMonsters\Classes\Characters\Heroes\Wizard;
use App\HeroesAndMonsters\Classes\Characters\Monsters\Dragon;
use App\HeroesAndMonsters\Classes\Characters\Monsters\Spider;
use App\HeroesAndMonsters\Classes\FightManager;
use App\HeroesAndMonsters\Classes\GameObjects\Lance;
use App\HeroesAndMonsters\Classes\GameObjects\Magic;
use App\HeroesAndMonsters\Classes\GameObjects\Sword;
use App\HeroesAndMonsters\Logs\Logger;

class HeroesAndMonstersController extends Controller
{
    /**
     * Displays the Heroes and Monsters page. Without the fight event demonstration. This is the
     * default.
     */
    public function heroesAndMonsters(): void
    {
        // Always pass $events (empty array) to avoid undefined variable in view
        $this->view('heroesAndMonsters', 
            [
                'events' => [],
            ]
        );
    }

    /**
     * Displays the Heroes and Monsters page, with the fight event demonstration.
     *
     * @return void
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

    private function startHeroesAndMonsters(): array
    {
        Logger::getInstance()->log('Game started!');

        /**
         * creating characters and game objects
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

        /**
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

        /**
         * Wizard learns new magic
         */
        // Logger::getInstance()->log('Wizard actions');
        $wizard->learnMagic($magic);
        $wizard->pickUpWeapon($sword); 

        /**
         * Fight 1
         */
        Logger::getInstance()->log('The epic fight Wizard vs Spider');
        $fightManager = new FightManager($wizard, $spider);
        $fightManager->fight();

        /**
         * Fight 2
         */
        // Logger::getInstance()->log('The epic fight Warrior vs Dragon');
        $fightManager = new FightManager($warrior, $dragon);
        $fightManager->fight();

        Logger::getInstance()->log('Game ended.');
        $events = Logger::getInstance()->getEvents();

        return $events;
    }
}