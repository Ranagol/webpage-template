<?php

namespace App\trains;

use Dotenv\Parser\Lines;
use App\trains\input\ScheduleMaker;
use App\trains\output\OutputWriter;
use App\trains\input\StringToLinesConverter;
use App\trains\calculation\TrainCalculator;
use App\Trains\Input\LinesToScheduleDataExtractor;

class TrainService 
{
    private StringToLinesConverter $converter;
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
        $this->converter = new StringToLinesConverter();
        $this->scheduleMaker = new ScheduleMaker();
        $this->trainCalculator = new TrainCalculator();
        $this->outputWriter = new OutputWriter();
    }

    public function handle(string $taskData): array
    {
        $lines = $this->converter->transformStringToLines($taskData);
        $schedules = $this->scheduleMaker->handle($lines);
        $schedulesWithResult = $this->trainCalculator->handle($schedules);
        $responses = $this->outputWriter->makeResponse($schedulesWithResult);

        return $responses;
    }
}