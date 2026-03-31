<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Logs;

class Logger
{
    /**
     * @var string[]
     */
    private static array $events = [];

    /**
     * This will store the instance of this class.
     */
    private static ?Logger $instance = null;

    /**
     * make the __construct private, because this way nobody will be able to initialize this class
     * from outside.
     */
    private function __construct()
    {
    }

    /**
     * If the object is not created yet, create it and return it. Otherwise, return the existing one.
     */
    public static function getInstance(): Logger
    {
        if (null == self::$instance) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    public function log(string $text): void
    {
        self::$events[] = $text;
    }

    /**
     * @return string[]
     */
    public function getEvents(): array
    {
        return self::$events;
    }
}
