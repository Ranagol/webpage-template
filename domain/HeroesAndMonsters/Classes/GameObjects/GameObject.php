<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Classes\GameObjects;

use Domain\HeroesAndMonsters\Logs\EventLogger;

/**
 * Everything in this game is by definiton a GameObject. This is the major base class for all things
 * in the game. All Characters, Monsters, Heroes, Weapons... etc inherit from this class.
 */
class GameObject
{
    /**
     * This is the ultimate parent class. Every time when a child object is created, this creation
     * needs to be logged, with the child class name. Optionally, logging can be suppressed.
     */
    public function __construct(bool $suppressLog = false)
    {
        if (!$suppressLog) {
            $className = $this->getClassName();
            EventLogger::getInstance()->log('A new ' . $className . ' has been created.');
        }
    }

    /**
     * we use late static binding, so we can always get the relevant, actual child class name.
     * So the end result is something like this: 'A new Warrior has been created.'
     * This gives the ability to every child class, to state its name. Which is necesary for the
     * storytelling, which is happening through logging.
     * Instead of this:
     * app/Classes/Characters/Heroes/Warrior.php
     * The function will return this: Warrior.
     */
    public function getClassName(): string
    {
        return basename(str_replace('\\', '/', static::class));
    }
}
