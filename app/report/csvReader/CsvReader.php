<?php

namespace App\Report\CsvReader;

class CsvReader
{
    //GETTING DATA FROM FILE, LINE BY LINE INTO AN ARRAY
    
    private $fileNameWithPath;
    private $lines = [];
    private $filePointer;

    public function __construct($fileNameWithPath)
    {
        $this->fileNameWithPath = $fileNameWithPath;
        $this->filePointer = fopen($this->getFileNameWithPath(), 'a+');//opening a file
    }

    /**
     * In some cases, the uploaded file needs to be read, changed (processed),
     * and in these cases we call this method.
     *
     * @return void
     */
    public static function processCsvFile(): void
    {
        
    }

    public function readCsvFile(): void
    {
        try {
            while (!feof($this->getFilePointer())) {//feof() tests if the end-of-file has been reached.
                $lines[] = fgets($this->getFilePointer());
            }
            echo '<pre>';
            var_dump($lines);
            echo '</pre>';
        } catch (\Throwable $e) {
            echo $e->getMessage();
        } finally {
            if ($this->getFilePointer()) {
                fclose($this->getFilePointer());
            }
        }
    }

    /**
     * Get the value of fileNameWithPath
     */ 
    public function getFileNameWithPath()
    {
        return $this->fileNameWithPath;
    }

    /**
     * Get the value of lines
     */ 
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * Get the value of filePointer
     */ 
    public function getFilePointer()
    {
        return $this->filePointer;
    }
}
