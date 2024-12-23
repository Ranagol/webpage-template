<?php

namespace App\trains\input;

use App\Trains\Input\TripAb;
use App\Trains\Input\TripBa;
use App\Exceptions\ScheduleMakerException;

/**
 * This class will create schedules from the input lines.
 * Here is a taskData sample, from which we need to create two schedules:
 * 2        
 * 5
 * 3 2
 * 09:00 12:00
 * 10:00 13:00
 * 11:00 12:30
 * 12:02 15:00
 * 09:00 10:30
 * 2
 * 2 0
 * 09:00 09:01
 * 12:00 12:02
 */
class ScheduleMaker {


    /**
     * Makes Schedule objects from the input lines.
     *
     * @param array $lines
     * @return array
     */
    public function handle(array $lines): array
    {
        $numberOfSchedules = $this->getNumberOfSchedules($lines);

        $schedules = [];
        
        /**
         * For every schedule, we need to extract the turnaround time, the number of trips, and the 
         * times from the task data. So we can createa Schedule object from them.
         */
        for ($i = 0; $i < $numberOfSchedules; $i++) {

            // Turnaround time extracting
            $turnaroundTime = $this->extractTurnaroundTime($lines);

            // Number of trips extracting
            $numberOfTrains = $this->extractNumberOfTrains($lines);
            $numberOfTrainsAb = $numberOfTrains[0];
            $numberOfTrainsBa = $numberOfTrains[1];

            // Travel times extracting and creating trains from travel times
            $trainsAtoB = $this->createTrains($lines, $numberOfTrainsAb, $turnaroundTime);
            $trainsBtoA = $this->createTrains($lines, $numberOfTrainsBa, $turnaroundTime);

            $schedule = $this->createSchedule(
                $turnaroundTime,
                $trainsAtoB,
                $trainsBtoA
            );

            $schedules[] = $schedule;   
        }

        return $schedules;
    }

    /**
     * Set the number of schedules, and removes them form the task data.
     * The $lines are is used by reference, so the original array will be changed. Notice the '&' sign.
     * array_shift returns the first element of the array and removes it from the array.
     */
    private function getNumberOfSchedules(array &$lines): int
    {
        /**
         * The first line in the input file is the number of schedules. So here we set the number of
         * schedules.
         */
        $numberOfSchedules = (int) array_shift($lines);

        return $numberOfSchedules;
    }

    /**
     * Extracts the turnaround time.
     * 
     * The $lines are is used by reference, so the original array will be changed. Notice the '&' sign.
     * array_shift returns the first element of the array and removes it from the array.
     *
     * @param array $lines
     * @return integer
     */
    private function extractTurnaroundTime(array &$lines): int
    {
        $line = array_shift($lines);

        return (int) $line;
    }

    /**
     * Extracts the number of trains 
     * 
     * The $lines are is used by reference, so the original array will be changed. Notice the '&' sign.
     * array_shift returns the first element of the array and removes it from the array.
     *
     * @param array $lines
     * @return array
     */
    private function extractNumberOfTrains(array &$lines): array
    {
        $line = array_shift($lines);

        $numberOfTrains = explode(' ', $line);
        $numberOfTrainsAb = (int) $numberOfTrains[0];
        $numberOfTrainsBa = (int) $numberOfTrains[1];

        return [$numberOfTrainsAb, $numberOfTrainsBa];
    }

    /**
     * Creates trains from the extracted travel times.
     *
     * @param array $lines
     * @param integer $numberOfTrains
     * @param float $turnaroundTime
     * @return array
     */
    private function createTrains(
        array &$lines, // Notice that here use array by reference: whatever we change here, it will be changed in the original array.
        int $numberOfTrains, 
        float $turnaroundTime
    ): array
    {
        $trains = [];

        for ($i = 0; $i < $numberOfTrains; $i++) {
            $line = array_shift($lines);
            $times = explode(' ', $line);

            // Extract departure time need to create a train object
            $departureTime = $times[0];

            // Extract arrival time need to create a train object
            $arrivalTime = $times[1];

            // Create a train
            $train = new Train(
                $turnaroundTime,
                $departureTime,
                $arrivalTime
            );

            $trains[] = $train;
        }

        return $trains;
    }

    /**
     * Creates a schedule from the extracted data.
     *
     * @param integer $turnaroundTime
     * @param array $trainsAtoB
     * @param array $trainsBtoA
     * @return Schedule
     */
    private function createSchedule(
        int $turnaroundTime,
        array $trainsAtoB,
        array $trainsBtoA
    ): Schedule
    {
    
        // Create a schedule
        $schedule = new Schedule(
            $turnaroundTime,
            $trainsAtoB,
            $trainsBtoA
        );

        return $schedule;
    }
}