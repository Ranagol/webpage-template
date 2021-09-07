<?php

namespace App\Report\ReportDomain;

use App\Report\ReportDomain\Reportable;

class CsvFile implements Reportable
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
     * Will contain the final report data in array, that we want to display for the user.
     *
     * @var array
     */
    private array $report;

    public function __construct(string $path, array $lines = [])
    {
        $this->path = $path;
        $this->lines = $lines;
        $this->mergeDuplicateLines();
    }

    /**
     * Will create the final report, by merging the same categories into one category.
     *
     * @return void
     */
    private function mergeDuplicateLines(): void
    {
        $lines = $this->getLines();
        $processedLines = [];

        //HERE WE ARE CREATING SUBARAYS BY CATEGORY, AND GIVE EVERY SUBARAY ITS VALUE.
        $categories = [];

        foreach ($lines as $key => $line) {
            $categoryName = $line->getCategory()->getCategory();

            //if there is already a category with this $categoryName... Then is has a (previous) value. We need to add the new value to the previous value.
            if (array_key_exists($categoryName, $categories)) {
                $previousCategoryValue = $categories[$categoryName];
                $newCategoryValue = $previousCategoryValue + $line->getLineSum();
                $categories[$categoryName] = $newCategoryValue;
            } else {
                //if categoryName does not exist, just simply add this value to the newly created category
                $categories[$categoryName] = $line->getLineSum();
            }
        }

        $this->report = $categories;
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
     * Will get the final report data in array, that we want to display for the user.
     *
     * @return  array
     */ 
    public function getReport(): array
    {
        return $this->report;
    }
}
