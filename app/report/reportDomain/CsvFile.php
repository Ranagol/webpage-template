<?php

namespace App\Report\ReportDomain;

class CsvFile
{
    /**
     * Path of the csv file
     *
     * @var string
     */
    private string $path;

    /**
     * These are the raw lines freshly arrived from the CsvReader.php. This means that some of
     * these lines are duplicates, some of these lines have the same category.
     *
     * @var array
     */
    private array $lines = [];

    /**
     * This array has processed lines. That means that there are no duplicates. The same category
     * lines are merged into one category. 
     * While in the $lines we have category, price and amount, in the $processedLines we can have
     * only category and sum.
     *
     * @var array
     */
    private array $processedLines = [];

    public function __construct(string $path, array $lines = [])
    {
        $this->path = $path;
        $this->lines = $lines;
        $this->mergeDuplicateLines();
    }

    /**
     * ITT ALLTAM MEG. A KOVETKEZO LEPES EXCELBEN LESZIMULALSNI KET OSZLOPBAN EZT A SZITUT.
     * EGY OSZLOP TARTALMA KEY, CATEGORY, SUM.
     * MASIK OSZLOP TARTALMA KEY, CATEGORY, SUM.
     * MENNI LEPESROL LEPESRE ES SZIMULALNI MI KELLENE HOGY TORTENJEN.
     *
     * @return void
     */
    public function mergeDuplicateLines(): void
    {
        $lines = $this->getLines();
        $processedLines = [];
        foreach ($lines as $key1 => $value1) {
            foreach ($lines as $key2 => $value2) {
                //case 1: keys =, values = : This is the same object, don't compare, don't do anything
                if ($value1->getCategory() === $value2->getCategory() && $key1 === $key2) {
                    //don't do anything///
                
                //case 2: keys !=, values = : This is a duplicate, merge lines, and delete the $key2 line
                } elseif($value1->getCategory() === $value2->getCategory() && $key1 !== $key2) {
                    $mergedSum = $value1->getLineSum() + $value2->getLineSum();
                    $processedLines[$value1->getCategory()->getCategory()] = $mergedSum;
                    unset($lines[$key2]);

                //case 3: keys !=, values != : These are totally different objects
                } elseif($value1->getCategory() !== $value2->getCategory() && $key1 !== $key2) {
                    //don't do anything///
                }
            }
        }
        print_r($processedLines);
        $x = 10;
    }


    public function getFileSum(): int
    {
        $sum = 0;
        $lines = $this->getProcessedLines();
        foreach ($lines as $line) {
            $sum = $sum + $line->getLineSum();
        }

        return $sum;
    }

    /**
     * Get the value of path
     */ 
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of lines
     * 
     * @return array
     */ 
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * Get the value of processedLines
     */ 
    public function getProcessedLines()
    {
        return $this->processedLines;
    }
}
