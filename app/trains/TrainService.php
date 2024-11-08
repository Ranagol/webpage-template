<?php

namespace App\trains;

use App\trains\input\Converter;
use App\trains\output\OutputWriter;
use App\trains\trainCalculator\TrainCalculator;
use App\trains\input\CaseMaker;

class TrainService 
{
    private Converter $converter;
    private TrainCalculator $trainCalculator;
    private OutputWriter $outputWriter;
    private CaseMaker $caseMaker;

    /**
     * Contains all the data from the input file, in one big string.
     *
     * @var string
     */
    private string $trainTimetableString;

    public function __construct()
    {
        $this->converter = new Converter();
        $this->caseMaker = new CaseMaker();
        $this->trainCalculator = new TrainCalculator();
        $this->outputWriter = new OutputWriter();
    }

    public function handle(string $trainTimetable): void
    {
        $lines = $this->converter->transformStringToLines($trainTimetable);
        $trainTimetableCases = $this->caseMaker->makeCases($lines);
    }
}