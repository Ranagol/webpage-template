<?php

namespace Tests\App\Trains\Calculation;

require_once dirname(__DIR__) . '/TrainsClassLoader.php';

use PHPUnit\Framework\TestCase;
use App\Trains\Input\ScheduleMaker;
use App\Trains\Calculation\TrainCalculator;

final class TrainCalculatorTest extends TestCase
{
    public function testCalculatesInitialTrainNeedsPerSchedule(): void
    {
        $lines = [
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
        ];

        $maker = new ScheduleMaker();
        $calculator = new TrainCalculator();

        $schedules = $maker->handle($lines);
        $result = $calculator->handle($schedules);

        $this->assertSame(2, $result[0]->getNumberOfTrainsA());
        $this->assertSame(2, $result[0]->getNumberOfTrainsB());
        $this->assertSame(2, $result[1]->getNumberOfTrainsA());
        $this->assertSame(0, $result[1]->getNumberOfTrainsB());
    }
}
