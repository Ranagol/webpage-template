<?php

namespace App\Trains;

use App\Trains\Input\ScheduleMaker;
use App\Trains\Output\OutputWriter;
use App\Trains\Input\StringToLinesConverter;
use App\Trains\Calculation\TrainCalculator;

/**
 * This is the main service class. It is responsible for handling the whole train task.
 */
class TrainService 
{

    public function __construct(
        private StringToLinesConverter $converter,
        private ScheduleMaker $scheduleMaker,
        private TrainCalculator $trainCalculator,
        private OutputWriter $outputWriter
    ) {}

    /**
     * This is the main method of the service. It handles the whole task. See the comments below for
     * more details.
     *
     * @param string $taskData
     * @return array
     */
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