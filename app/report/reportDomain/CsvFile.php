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

    public function mergeDuplicateLines(): void
    {
        // $lines = $this->getLines();
        // $processedLines = [];
        // foreach ($lines as $key1 => $value1) {
        //     foreach ($lines as $key2 => $value2) {
        //         if ($value1->getCategory() === $value2->getCategory()) {
        //             $mergedSum = $value1->getLineSum() + $value2->getLineSum();
        //             $processedLines[$value1->getCategory()] = $mergedSum();
        //             unset($lines[$key2]);
        //         } else {
        //             $processedLines[$value1->getCategory()] = $value1->getLineSum();
        //         }
        //     }
        // }
        // print_r($processedLines);
        // $x = 10;
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
