<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Logs;

class Logger {

    private static array $events = [];

    /**
     * This will store the instance of this class.
     *
     * @var Logger|null
     */
    private static ?Logger $instance = null;

    /**
     * make the __construct private, because this way nobody will be able to initialize this class 
     * from outside.
     */
    private function __construct() {}

    /**
     * If the object is not created yet, create it and return it. Otherwise, return the existing one.
     *
     * @return Logger
     */
    static function getInstance(): Logger
    {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    public function log(String $text): void
    {
        self::$events[] = $text;
    }

    public function getEvents(): array
    {
        return self::$events;
    }
}