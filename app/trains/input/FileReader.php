<?php

namespace App\trains\input;

class FileReader
{
    private string $inputFilePath = 'app\trains\STDIN';

    private array $allFileLines;

    private int $numberOfCases;


    public function read(): void
    {
        $this->getAllFileLines();
        $this->numberOfCases = $this->allFileLines[0];
    }

    private function getAllFileLines(): void
    {
        $this->allFileLines = file($this->inputFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $t = 8;
    }
}