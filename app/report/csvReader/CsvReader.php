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
        $this->processCsvFile($email, $fileName);
    }

    /**
     * In some cases, the uploaded file needs to be read, changed (processed),
     * and in these cases we call this method.
     *
     * @return void
     */
    public function processCsvFile(string $email, string $fileName): void
    {
        $this->createFilePath($email, $fileName);
        $this->createFilePointer();
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
                $lines[] = $line;
            }
            var_dump($lines);


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



    private function createFilePointer(): void
    {

        try {
            if (file_exists($this->getFileNameWithPath())) {
                echo 'file exists';
                $this->filePointer = fopen($this->getFileNameWithPath(), 'r');//opening a file
            }
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }

        
    }




    private function createFilePath(string $email, string $fileName)
    {
        $path = __DIR__ . '/../../../storage/upload/' . $email . '/' . $fileName;

        $this->fileNameWithPath = $path;
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
