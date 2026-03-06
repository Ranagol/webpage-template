<?php

namespace Tests\App\Trains\Input;

require_once dirname(__DIR__) . '/TrainsClassLoader.php';

use App\Trains\Input\Train;
use App\Trains\Input\Schedule;
use PHPUnit\Framework\TestCase;

final class ScheduleTest extends TestCase
{
    public function testScheduleGettersAndTrainCounters(): void
    {
        $aToB = [new Train(5, '09:00', '10:00'), new Train(5, '10:00', '11:00')];
        $bToA = [new Train(5, '09:30', '10:30')];

        $schedule = new Schedule(5, $aToB, $bToA);

        $this->assertSame(5.0, $schedule->getTurnaroundTime());
        $this->assertCount(2, $schedule->getTripsAtoB());
        $this->assertCount(1, $schedule->getTripsBtoA());
        $this->assertSame(2, $schedule->getNumberOfTrainsA());
        $this->assertSame(1, $schedule->getNumberOfTrainsB());

        $schedule->reduceNumberOfTrainsInA(1);
        $schedule->reduceNumberOfTrainsInB(1);

        $this->assertSame(1, $schedule->getNumberOfTrainsA());
        $this->assertSame(0, $schedule->getNumberOfTrainsB());
    }
}
