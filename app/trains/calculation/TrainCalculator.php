<?php

namespace App\trains\calculation;

class TrainCalculator
{
    /**
     * Stores all the Schedule objects in an array.
     *
     * @var array
     */
    private array $schedules = [];

    //*******THESE HERE ARE TEMPORARY STORAGES********** */
    private int $numberOfTrainsA = 0;
    private int $numberOfTrainsB = 0;



    public function handle(array $schedules)
    {
        $this->schedules = $schedules;

        foreach ($this->schedules as $schedule) {

            /**
             * Here we set the initial number of trains needed at the start of the day. Simple: in
             * worst case scneario, when there are no reusable trains, we must have as much trains in
             * the given station, as much trips are in the schedule. 
             */
            $this->numberOfTrainsA = count($schedule->getTripsAtoB());
            $this->numberOfTrainsB = count($schedule->getTripsBtoA());
        }

        // Just return the schedules that contain their needed number of trains
        return $this->schedules;
    }


}