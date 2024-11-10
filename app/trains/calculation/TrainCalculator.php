<?php

namespace App\trains\calculation;

class TrainCalculator
{
    public function calculate(array $schedules): array
    {
        $result = [];
        foreach ($schedules as $schedule) {
            // $result[] = $this->calculateSchedule($schedule);
        }

        return $result;
    }
}