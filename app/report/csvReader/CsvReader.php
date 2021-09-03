<?php

namespace App\Report\CsvReader;

class CsvReader
{
    //GETTING DATA FROM FILE, LINE BY LINE INTO AN ARRAY
    
    private $fileNameWithPath;
    private $lines = [];
    private $filePointer;

    public function __construct(string $email, string $fileName)
    {
        $this->fileNameWithPath = $this->createFilePath($email, $fileName);
        $this->filePointer = fopen($this->getFileNameWithPath(), 'a+');//opening a file

        $this->processCsvFile();
    }

    private function createFilePath(string $email, string $fileName): string
    {
        $path = __DIR__ . '/../../../storage/upload/' . $email . '/' . $fileName . '.csv';

        return $path;
    }

    /**
     * In some cases, the uploaded file needs to be read, changed (processed),
     * and in these cases we call this method.
     *
     * @return void
     */
    public function processCsvFile(): void
    {
        $this->readCsvFile();
    }

    /**
     * https://stackoverflow.com/questions/1269562/how-to-create-an-array-from-a-csv-file-using-php-and-the-fgetcsv-function
     *
     * @return void
     */
    public function readCsvFile(): void
    {
        try {
            
            
            $file = fopen($this->getFileNameWithPath(), 'r');
            $lines = [];
            while (($line = fgetcsv($file)) !== FALSE) {
            //$line is an array of the csv elements
                $lines[$line];
            }
            var_dump($lines);

            $f = 5;



            // while (!feof($filePointer)) {//feof() tests if the end-of-file has been reached.
            //     $lines[] = fgets($filePointer);
            // }
            // echo '<pre>';
            // var_dump($lines);
            // echo '</pre>';
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
