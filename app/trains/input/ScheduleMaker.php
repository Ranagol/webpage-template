<?php

namespace App\trains\input;

use App\Exceptions\BaseException;
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
     * For example, in the sample trainTimetable above, the number of schedules is 2. We have two 
     * train timetables, two schedules.
     *
     * @var integer
     */
    private int $numberOfSchedules;

    /**
     * Contains the lines without the number of schedules. This will be used for future processing.
     *
     * @var array
     */
    private array $linesWithoutNumberOfSchedules = [];//TODO ANDOR TOROLD EZT KI. REFACTOR. MINNEL KEVESEBB PROPERTIES LEGYEN.

    /**
     * Temporary variables for storing the schedule data.
     */
    private null|float $turnaroundTime = null;
    private null|int $numberOfTripsAb = null;
    private null|int $numberOfTripsBa = null;
    private array $tripsAb = [];
    private array $tripsBa = [];
    private bool $isTurnaroundTimeSet = false;
    private bool $isNumberOfTripsSet = false;

    /**
     * Stores all the Schedule objects in an array. Aka this is the final result created by this class.
     *
     * @var array
     */
    private array $schedules = [];

    /**
     * Makes Schedule objects from the input lines.
     *
     * @param array $lines
     * @return array
     */
    public function handle(array $lines)
    {
        $this->setNumberOfSchedules($lines);

        $this->makeSchedules($this->linesWithoutNumberOfSchedules);

        return $this->schedules;
    }

    /**
     * Set the number of schedules, and removes them form the task data.
     * 
     * @param array $lines
     * @return array
     */
    private function setNumberOfSchedules(array $lines): void
    {
        //TODO ANDOR ARRAY UNSHIFT VAGY POP VAGY AKARMI EGY SORBAN MEGCSINALJA 3 SOR HELYETT
        // The first line in the input file is the number of schedules.
        $this->numberOfSchedules = (int) $lines[0];

        // Remove the first element, the number of schedules. We don't need it anymore.
        unset($lines[0]);

        // Reset the indexing
        $lines = array_values($lines);

        $this->linesWithoutNumberOfSchedules = $lines;
    }

    /**
     * At this stage, there are three tipes of lines (which are repeated in the taskData):
    * 5             //contains one number. This is the turnaround time.
    * 3 2           //contains two numbers. First one is number of trips from A to B, second one is number of trips from B to A.
    * 09:00 12:00   //contains two times. First one is departure time, second one is arrival time.
     *
     * @param array $lines
     * @return void
     */
    private function makeSchedules(array $lines): void
    { 
        foreach ($lines as $line) {

            /**
             * Here we go line by line. For every line these 4 functions are called, conditionally.
             * For conditions, see the functions.
             */
            $this->extractTurnaroundTime($line);
            $this->extractNumberOfTrips($line);
            $this->extractTimes($line);

            // If all the data is extracted, then create a schedule.
            $this->createSchedule();
        }
    }

    /**
     * Extracts the turnaround time from the line.
     * At the beginning, this function gets a random line. 
     * If the turnaround time is not set yet, and the line contains the turnaround time, then the
     * this function will be triggered.
     *
     * @param string $line
     * @return void
     */
    private function extractTurnaroundTime(string $line): void
    {
        // Turnoaround time
        if ($this->isTurnaroundTimeSet === false && $this->isTurnaroundTime($line) === true) {
            $this->turnaroundTime = (int) $line;
            $this->isTurnaroundTimeSet = true;
        }
    }

    /**
     * Check if the line contains the turnaround time.
     * Turnaround time line has no space. All other lines will contain at least one space. This is 
     * how this function recognizes the turnaround time line.
     * 
     * @param string $line
     * @return boolean
     */
    private function isTurnaroundTime(string $line): bool
    {
        // If the line does not contain a space, then it is the turnaround time.
        if (str_contains($line, ' ')) {
            return false;
        }

        return true;
    }

    /**
     * Extracts the number of trips from A to B and from B to A.
     * If the number of trips is not set yet, and the line contains the number of trips, then this 
     * function will be triggered.
     *
     * @param string $line
     * @return void
     */
    private function extractNumberOfTrips(string $line): void
    {
        // Number of trips
        if ($this->isNumberOfTripsSet === false && $this->isNumberOfTrips($line)) {
            $numberOfTrips = explode(' ', $line);
            $this->numberOfTripsAb = (int) $numberOfTrips[0];
            $this->numberOfTripsBa = (int) $numberOfTrips[1];
            $this->isNumberOfTripsSet = true;
        } 
    }

    /**
     * Number of trips line will have one space always. This is how this function recognizes the
     * number of trips line.
     *
     * @param string $line
     * @return boolean
     */
    private function isNumberOfTrips(string $line): bool
    {
        if (str_contains($line, ' ')) {
            return true;
        } 

        return false;
    }

    /**
     * Extracts the departure and arrival times.
     * 
     *
     * @param string $line
     * @return void
     * @throws Exception
     */
    private function extractTimes(string $line)
    {
        // This is the last extractor. 
        if ($this->isDepartureArrivalTime($line)) {
            $times = explode(' ', $line);
            $departureTime = $times[0];
            $arrivalTime = $times[1];

            
            if ($this->numberOfTripsAb > 0) {
                $this->extractAbTimes($departureTime, $arrivalTime);
            } elseif ($this->numberOfTripsBa > 0) {
                $this->extractBaTimes($departureTime, $arrivalTime);
            } else {
                throw new ScheduleMakerException('Error while extracting times.');
            }
        }
    }

    /**
     * Check if the line contains departure and arrival times.
     * Departure and arrival time lines will have always two double dots and one space.
     *
     * @param string $line
     * @return boolean
     */
    private function isDepartureArrivalTime(string $line): bool
    {
        if (str_contains($line, ':') && str_contains($line, ' ')) {
            return true;
        }

        return false;
    }

    /**
     * Extracts the departure and arrival times for A to B trips. And stores it in the $this->tripsAb.
     *
     * @param string $departureTime
     * @param string $arrivalTime
     * @return void
     */
    private function extractAbTimes(string $departureTime, string $arrivalTime)
    {
        $this->tripsAb[] = new TripAb(
            $this->turnaroundTime, 
            $departureTime, 
            $arrivalTime
        );
        $this->numberOfTripsAb--;
    }

    /**
     * Extracts the departure and arrival times for B to A trips. And stores it in the $this->tripsBa.
     *
     * @param string $departureTime
     * @param string $arrivalTime
     * @return void
     */
    private function extractBaTimes(string $departureTime, string $arrivalTime)
    {
        $this->tripsBa[] = new TripBa(
            $this->turnaroundTime, 
            $departureTime, 
            $arrivalTime
        );
        $this->numberOfTripsBa--;
    }

    /**
     * Creates a schedule.
     * This function too is called for every line. It should be only triggered when all the A to B 
     * trips and B to A trips are extracted. 
     * When A to B trips all are extracted, the $this->numberOfTripsAb will be 0.
     * When B to A trips all are extracted, the $this->numberOfTripsBa will be 0.
     * Only then will this function be triggered.
     * @return void
     */
    private function createSchedule(): void
    {
        if ($this->numberOfTripsAb !== 0 || $this->numberOfTripsBa !== 0) {
            //TODO ANDOR EARLY RETURN LEARN ABOUT THIS
            return;
        }   
    
        // Create a schedule
        $schedule = new Schedule(
            $this->turnaroundTime,
            $this->tripsAb,
            $this->tripsBa
        );

        $this->schedules[] = $schedule;

        // Now reset all schedule variables, so we can create the next schedule
        $this->resetScheduleVariables();
    }

    /**
     * Resets the schedule variables, after the schedule is created we have to reset all the temporary
     * variables that stored the schedule data. Because we are in a loop, and now we have to create
     * the next schedule. Or we have finished creating schedules, and because of that we have to reset
     * the variables.
     *
     * @return void
     */
    private function resetScheduleVariables()
    {
        $this->turnaroundTime = null;
        $this->numberOfTripsAb = null;
        $this->numberOfTripsBa = null;
        $this->tripsAb = [];
        $this->tripsBa = [];
        $this->isTurnaroundTimeSet = false;
        $this->isNumberOfTripsSet = false;
    }
}