<?php

namespace App\trains\calculation;

use App\trains\input\Schedule;

class TrainCalculator
{
    /**
     * This method calculates the number of trains needed for every schedule.
     * 
     * We simply loop through every Schedule object, calculate the number of trains needed for every schedule,
     * add this result to the Schedule object, and return the array of Schedule objects.
     * 
     * @param array $schedules
     * @return array
     */
    public function handle(array $schedules)
    {
        foreach ($schedules as $schedule) {
            $this->calculate($schedule);
        }

        return $schedules;
    }

    /**
     * This method calculates the number of trains needed for a single schedule, for station A and B.
     * 
     * @param Schedule $schedule
     */
    private function calculate(Schedule $schedule): void
    {
        $tripsAtoB = $schedule->getTripsAtoB();
        $tripsBtoA = $schedule->getTripsBtoA();

        foreach ($tripsAtoB as $tripAtoB) {
            foreach ($tripsBtoA as $tripBtoA) {

                /**
                 * If the arrival + turnaround time for train A is less than the departure time for
                 * train B, 
                 * and
                 * if the train A is not reused yet for another trip,
                 * then the train A can be reused for the trip BtoA.
                 * That means that we can reduce the number of initial trains in B with one.
                 */
                if ($tripAtoB->getArrivalTurnaroundSum()->lessThan($tripBtoA->getDepartureTime()) && !$tripAtoB->getIsReused()) {
                    $tripAtoB->setIsReused(true);
                    $schedule->reduceNumberOfTrainsInB(1);
                }

                /**
                 * If the arrival + turnaround time for train B is less than the departure time for
                 * train A, 
                 * and
                 * if the train B is not reused yet for another trip,
                 * then the train B can be reused for the trip AtoB.
                 * That means that we can reduce the number of initial trains in A with one.
                 */
                if ($tripBtoA->getArrivalTurnaroundSum()->lessThan($tripAtoB->getDepartureTime()) && !$tripBtoA->getIsReused()) {
                    $tripBtoA->setIsReused(true);
                    $schedule->reduceNumberOfTrainsInA(1);
                }
            }
        }
    }


}