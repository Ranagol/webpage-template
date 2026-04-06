<?php

declare(strict_types=1);

namespace Tests\Feature;

use Domain\Trains\Calculation\TrainCalculator;
use Domain\Trains\Input\ScheduleMaker;
use Domain\Trains\Input\StringToLinesConverter;
use Domain\Trains\Output\OutputWriter;
use Domain\Trains\TrainService;
use PHPUnit\Framework\TestCase;

final class TrainServiceTest extends TestCase
{
    public function testHandleProcessesFullTaskData(): void
    {
        $taskData = implode(PHP_EOL, [
            '2',
            '5',
            '3 2',
            '09:00 12:00',
            '10:00 13:00',
            '11:00 12:30',
            '12:02 15:00',
            '09:00 10:30',
            '2',
            '2 0',
            '09:00 09:01',
            '12:00 12:02',
            '',
        ]);

        $service = new TrainService(
            new StringToLinesConverter(),
            new ScheduleMaker(),
            new TrainCalculator(),
            new OutputWriter()
        );

        $result = $service->handle($taskData);

        $this->assertSame(['Case #1: 2 2', 'Case #2: 2 0'], $result);
    }
}