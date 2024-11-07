<?php

namespace App\trains;

use App\trains\input\FileReader;
use App\trains\output\OutputWriter;
use App\trains\trainCalculator\TrainCalculator;

class TrainService 
{
    private FileReader $fileReader;
    private TrainCalculator $trainCalculator;
    private OutputWriter $outputWriter;

    /**
     * Contains all the data from the input file, in one big string.
     *
     * @var string
     */
    private string $trainTimetableString;


    public function __construct(string $trainTimetableString)
    {
        $this->trainTimetableString = $trainTimetableString;
        $this->fileReader = new FileReader();
        $this->trainCalculator = new TrainCalculator();
        $this->outputWriter = new OutputWriter();
    }

    public function handle(): void
    {
        $t = 7;
        $this->fileReader->read();
        $t = 8;
        // var_dump($this);
    }
}