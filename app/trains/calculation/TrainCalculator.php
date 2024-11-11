<?php

namespace App\trains\calculation;

use App\trains\input\Schedule;

class TrainCalculator
{
    /**
     * Stores all the Schedule objects in an array.
     *
     * @var array
     */
    private array $schedules = [];

    public function handle(array $schedules)
    {
        $this->schedules = $schedules;

        foreach ($this->schedules as $schedule) {
            $this->calculate($schedule);
        }

        // Just return the schedules that contain their needed number of trains
        return $this->schedules;
    }

    private function calculate(Schedule $schedule): void
    {
        $tripsAtoB = $schedule->getTripsAtoB();
        $tripsBtoA = $schedule->getTripsBtoA();

        foreach ($tripsAtoB as $tripAtoB) {
            foreach ($tripsBtoA as $tripBtoA) {

                /**
                 * If the arrival + turnaround time for train A is less than the departure time for
                 * train B, then the train A can be reused for the trip BtoA.
                 * That means that we can reduce the number of initial trains in B with one.
                 */
                if ($tripAtoB->getArrivalTurnaroundSum()->lessThan($tripBtoA->getDepartureTime())) {
                    $schedule->reduceNumberOfTrainsB(1);
                }

                /**
                 * If the arrival + turnaround time for train B is less than the departure time for
                 * train A, then the train B can be reused for the trip AtoB.
                 * That means that we can reduce the number of initial trains in A with one.
                 */
                if ($tripBtoA->getArrivalTurnaroundSum()->lessThan($tripAtoB->getDepartureTime())) {
                    $schedule->reduceNumberOfTrainsA(1);
                }
            }
        }
    }


}