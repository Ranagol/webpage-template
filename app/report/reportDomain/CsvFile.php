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

        print_r($categories);
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
