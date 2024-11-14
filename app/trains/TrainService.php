<?php

namespace App\trains;

use App\trains\input\ScheduleMaker;
use App\trains\output\OutputWriter;
use App\trains\input\StringToLinesConverter;
use App\trains\calculation\TrainCalculator;

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

    public function __construct(
        StringToLinesConverter $converter,
        ScheduleMaker $scheduleMaker,
        TrainCalculator $trainCalculator,
        OutputWriter $outputWriter
    ) {
        $this->converter = $converter;
        $this->scheduleMaker = $scheduleMaker;
        $this->trainCalculator = $trainCalculator;
        $this->outputWriter = $outputWriter;
    }


    public function handle(string $taskData): array
    {
        // Transforms the big, useless, initial string into useful lines.
        $lines = $this->converter->transformStringToLines($taskData);

        // Creates the schedule objects from the $lines. In the sample task we have 2 schedules.
        $schedules = $this->scheduleMaker->handle($lines);

        // Calculates the number of trains needed for every schedule, and attaches the result to the schedule.
        $schedulesWithResult = $this->trainCalculator->handle($schedules);

        // Makes the output strings from the schedules with the result.
        $responses = $this->outputWriter->makeResponse($schedulesWithResult);

        return $responses;
    }
}