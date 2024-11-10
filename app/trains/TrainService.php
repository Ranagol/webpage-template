<?php

namespace App\trains;

use App\trains\input\Converter;
use App\trains\output\OutputWriter;
use App\trains\trainCalculator\TrainCalculator;
use App\trains\input\ScheduleMaker;

class TrainService 
{
    private Converter $converter;
    private ScheduleMaker $scheduleMaker;
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
        $this->scheduleMaker = new ScheduleMaker();
        $this->trainCalculator = new TrainCalculator();
        $this->outputWriter = new OutputWriter();
    }

    public function handle(string $taskData): void
    {
        $lines = $this->converter->transformStringToLines($taskData);
        $schedules = $this->scheduleMaker->handle($lines);
        $t = 8;
        // $result = $this->trainCalculator->calculate($schedules);
        // $this->outputWriter->write($result);
    }
}