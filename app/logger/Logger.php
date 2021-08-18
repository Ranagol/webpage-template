<?php

namespace App\logger;

use Exception;

/**
 * This class is a singleton. It has one purpose: 
 * to write error logs.
 */
class Logger
{
    /**
     * The singleton will be stored here.
     *
     * @var Logger
     */
    private static $instance;

    /**
     * The path to the file, where all logs are written.
     *
     * @var string
     */
    private $path = 'D:\_CODE\webpage-template\storage\logs\myLogs.txt';

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
     * @return void
     */
    static public function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    /**
     * Logs simple string messages.
     *
     * @param String $string
     * @return void
     */
    public function log(String $string): void
    {
        $date = date('Y-m-d H:i:s');
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
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }
}
