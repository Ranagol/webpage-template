<?php

namespace App\Logger;

use Exception;

/**
 * This class is a singleton. It has one purpose: 
 * to write error logs, into the /../../storage/logs/myLogs.txt'.
 */
class Logger
{
    /**
     * The singleton object will be stored here, in the Logger class.
     *
     * @var Logger $instance
     */
    private static $instance;

    /**
     * The path to the file, where all logs are written.
     *
     * @var string $path
     */
    private $path = __DIR__ . '/../../storage/logs/myLogs.txt';

    /**
     * This is deliberatly a private construct.
     * This way, this class can't be initiated outside of this class.
     */
    private function __construct() { }

    /**
     * This is how we can get this singleton class, and how we can log something
     * Example: 
     * Logger::getInstance()->log('Random textfff.');
     *
     * @return self
     */
    static public function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    /**
     * Logs simple string messages. For testing, debugging...
     * Example: 
     * Logger::getInstance()->log('Your custom error message.');
     *
     * @param string $string
     * 
     * @return void
     */
    public function log(string $string): void
    {
        $date = PHP_EOL . date('Y-m-d H:i:s');
        $string = $date . ' - ' . $string . PHP_EOL;
        $filePointer = fopen($this->getPath(), 'a+');
        fwrite($filePointer, $string);//writing into a file
        fclose($filePointer);//closing a file
    }

    /**
     * Logs Exceptions errors. 
     * Example how to use: 
     * 
     *     try {
     *           throw new Exception('Just a random exception error message');
     *       } catch (Exception $error) {
     *           Logger::getInstance()->logError($error);
     *       }
     *
     * @param Exception $error
     * 
     * @return void
     */
    public function logError(Exception $error): void
    {
        $date = PHP_EOL . date('Y-m-d H:i:s');
        $errorMessage = 'Error message: ' . $error->getMessage() . '.' . PHP_EOL;
        $line = 'The exception was created on this line: ' . $error->getLine() . '.' . PHP_EOL;
        $file = 'The exceptions was created in this file: ' . $error->getFile() . '.' . PHP_EOL;
        $trace = $error->getTrace();
        
        $firstLine = $date . ' - ' . $errorMessage . $file . $line;

        $filePointer = fopen($this->getPath(), 'a+');
        fwrite($filePointer, $firstLine);//writing into a file

        foreach ($trace as $item) {
            if (isset($item['file'])) {
                fwrite($filePointer, $item['file'] . ' on line ' . $item['line'] . PHP_EOL);
            }
        }
        fclose($filePointer);//closing a file
    }

    /**
     * Get the value of path, where the log is.
     * 
     * @return string
     */ 
    public function getPath(): string
    {
        return $this->path;
    }
}
