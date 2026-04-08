<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Services;

use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Warrior;
use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Wizard;
use Domain\HeroesAndMonsters\Classes\Characters\Monsters\Dragon;
use Domain\HeroesAndMonsters\Classes\Characters\Monsters\Spider;
use Domain\HeroesAndMonsters\Classes\FightManager;
use Domain\HeroesAndMonsters\Classes\GameObjects\Lance;
use Domain\HeroesAndMonsters\Classes\GameObjects\Magic;
use Domain\HeroesAndMonsters\Classes\GameObjects\Sword;
use Domain\HeroesAndMonsters\Exceptions\WizardCanNotUseWeaponException;
use Domain\HeroesAndMonsters\Interfaces\HeroServiceInterface;
use Domain\HeroesAndMonsters\Logs\EventLogger;

class HeroService implements HeroServiceInterface
{
    /**
     * This is where everything happens regarding the heroes and monster. This is where we set up
     * all the actions, or the fights.
     *
     * WARNING: all commented out lines are working perfectly. I just had to shorten the output of
     * the demonstration, because of psychological reasons - I do not want my future employer to
     * fall asleep of boredom while checking out the demonstration.
     *
     * @return string[]
     */
    public function startHeroesAndMonsters(): array
    {
        EventLogger::getInstance()->log('Game started!');

        /**
         * creating characters and game objects.
         */
        // EventLogger::getInstance()->log('Creating characters and game objects');
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
        // EventLogger::getInstance()->log('Warrior actions');
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
        // EventLogger::getInstance()->log('Wizard actions');
        $wizard->learnMagic($magic);

        try {
            $wizard->pickUpWeapon($sword);
        } catch (WizardCanNotUseWeaponException $e) {
            EventLogger::getInstance()->log('Wizard tried to pick up a weapon, which is forbidden.');
        }

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

        EventLogger::getInstance()->log('Game ended.');
        EventLogger::getInstance()->log('Feel free to check out in the source code the php classes like the Warrior and the Dragon. :)');
        $events = EventLogger::getInstance()->getEvents();

        return $events;
    }
}
