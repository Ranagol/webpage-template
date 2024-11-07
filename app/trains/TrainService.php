<?php

namespace App\trains;

use App\trains\input\Converter;
use App\trains\output\OutputWriter;
use App\trains\trainCalculator\TrainCalculator;

class TrainService 
{
    private Converter $converter;
    private TrainCalculator $trainCalculator;
    private OutputWriter $outputWriter;

    /**
     * Contains all the data from the input file, in one big string.
     *
     * @var string
     */
    private string $trainTimetableString;


    public function __construct()
    {
        $this->converter = new Converter();
        $this->trainCalculator = new TrainCalculator();
        $this->outputWriter = new OutputWriter();
    }

    public function handle(string $trainTimetable): void
    {
        $lines = $this->converter->transformStringToLines($trainTimetable);
        $cases = $this->caseMaker->makeCases($lines);
    }
}