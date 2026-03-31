<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Logs;

class Logger {

    /**
     * Path for the log file.
     *
     * @var string
     */
    private static $pathForLogs = __DIR__ . '/logs.txt';

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
        self::displayOnMonitor($text);
        self::writeToFile($text);
    }

    private function displayOnMonitor(String $text): void
    {
        echo '<br>' . $text . '<br>';
    }

    private function writeToFile(String $text): void
    {
        file_put_contents(self::getPathForLogs(), $text . PHP_EOL, FILE_APPEND);
    }

    public static function getPathForLogs(): string
    {
        return self::$pathForLogs;
    }
}