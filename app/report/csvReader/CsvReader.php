<?php

namespace App\Report\CsvReader;

use Exception;
use App\Report\ReportDomain\Line;
use App\Report\ReportDomain\Price;
use App\Report\ReportDomain\Amount;
use App\Report\ReportDomain\CsvFile;
use App\Report\ReportDomain\Category;

class CsvReader
{
    /**
     * Stores the file path.
     *
     * @var string
     */
    private string $fileNameWithPath;
    
    /**
     * We store here the opened file. This will be used for further file manage operations.
     *
     * @var [type]
     */
    private $filePointer;

    private CsvFile $csvFile;

    public function __construct(string $email, string $fileName)
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
    private function readCsvFile(): void
    {
        $lines = [];

        try {
            // $file = fopen($this->getFileNameWithPath(), 'r');
            
            //this is how we can read csv file line by line. The result will be an array o arrays.
            while (($lineFromCsv = fgetcsv($this->getFilePointer())) !== false) {
            //$lineFromCsv is an array of the csv elements
                // print_r($lineFromCsv);
                $category = new Category($lineFromCsv[0]);
                $price = new Price($lineFromCsv[1]);
                $amount = new Amount($lineFromCsv[2]);
                $line = new Line($category, $price, $amount);
                $lines[] = $line;
            }

        } catch (\Throwable $e) {
            //TODO I need to correct this later...
            var_dump($e->getMessage() . PHP_EOL);//will shjow the actual error message, aka what is the issue
            var_dump($e->getTrace());//will show where could be the error. This function will return an array. This array will have values. These values will be the parts of the apps that were activated during/before this current exception was thrown. We need to ignore all values, that are in the vendor, and we need to find the first value (part of the app, that is not in the vendor)

            //where the exception was created (where the actual error is and where the exeption was created are not the same! If we can’t find the first, the latter may be useful)
            var_dump($e->getFile() . PHP_EOL);//gets the file in which the exception was created
            var_dump($e->getLine() . PHP_EOL);//gets the line in which the exception was created

        } finally {
            if ($this->getFilePointer()) {
                fclose($this->getFilePointer());
            }
        }

        $csvFile = new CsvFile($this->getFileNameWithPath(), $lines);
        
        $this->csvFile = $csvFile;
    }

    private function createFilePointer(): void
    {
        try {
            clearstatcache();//deleting cached stuff
            if (file_exists($this->getFileNameWithPath())) {
                // echo 'file exists';
                $this->filePointer = fopen($this->getFileNameWithPath(), 'r');//opening a file
            } else {
                throw new Exception('We have issue with the filePointer, we cant find the file...' . __FILE__ . __LINE__);
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
     * Get the value of filePointer
     */ 
    public function getFilePointer()
    {
        return $this->filePointer;
    }

    /**
     * Get the value of csvFile
     */ 
    public function getCsvFile()
    {
        return $this->csvFile;
    }
}
