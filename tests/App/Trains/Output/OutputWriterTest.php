<?php

namespace Tests\App\Trains\Output;

require_once dirname(__DIR__) . '/TrainsClassLoader.php';

use PHPUnit\Framework\TestCase;
use App\Trains\Input\Schedule;
use App\Trains\Input\Train;
use App\Trains\Output\OutputWriter;

final class OutputWriterTest extends TestCase
{
    public function testBuildsCliOutputRowsFromSchedules(): void
    {
        $schedule1 = new Schedule(
            5,
            [new Train(5, '09:00', '12:00'), new Train(5, '10:00', '13:00')],
            [new Train(5, '09:00', '10:00'), new Train(5, '12:00', '13:00')]
        );

        $schedule2 = new Schedule(
            5,
            [new Train(5, '09:00', '09:01'), new Train(5, '12:00', '12:02')],
            []
        );

        $writer = new OutputWriter();
        $result = $writer->makeResponse([$schedule1, $schedule2]);

        $this->assertSame(['Case #1: 2 2', 'Case #2: 2 0'], $result);
    }
}
