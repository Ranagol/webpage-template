<?php

declare(strict_types=1);

namespace Tests\Domain\Trains\Input;

use Domain\Trains\Input\Schedule;
use Domain\Trains\Input\ScheduleMaker;
use PHPUnit\Framework\TestCase;

final class ScheduleMakerTest extends TestCase
{
    public function testBuildsSchedulesFromInputLines(): void
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
        $schedules = $maker->handle($lines);

        $this->assertCount(2, $schedules);
        $this->assertInstanceOf(Schedule::class, $schedules[0]);
        $this->assertCount(3, $schedules[0]->getTripsAtoB());
        $this->assertCount(2, $schedules[0]->getTripsBtoA());
        $this->assertCount(2, $schedules[1]->getTripsAtoB());
        $this->assertCount(0, $schedules[1]->getTripsBtoA());
    }
}
