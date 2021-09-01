<?php

namespace App\Report\ReportDomain;

class CsvFile
{
    private $path;

    private $lines = [];

    public function __construct(string $path, array $lines = [])
    {
        $this->path = $path;
        $this->lines = $lines;
    }

    public function getSum(): int
    {
        $sum = 0;
        $lines = $this->getLines();
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
}
