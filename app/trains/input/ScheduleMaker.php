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

    private array $linesWithoutNumberOfSchedules = [];

    private null|float $turnaroundTime = null;
    private null|int $numberOfTripsAb = null;
    private null|int $numberOfTripsBa = null;
    private array $tripsAb = [];
    private array $tripsBa = [];
    private bool $isTurnaroundTimeSet = false;
    private bool $isNumberOfTripsSet = false;

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

        for ($i = $this->numberOfSchedules; $i > 0; $i--) {
            $this->extractDataFromLines($this->linesWithoutNumberOfSchedules);
            $this->createSchedule();
            // Now reset all schedule variables, so we can create the next schedule
            $this->resetScheduleVariables();
        }

        return $this->schedules;
    }

    /**
     * Set the number of schedules, and removes them form the task data.
     * 
     * @param array $lines
     * @return array
     */
    private function setNumberOfSchedules(array $lines): array
    {
        // The first line in the input file is the number of schedules.
        $this->numberOfSchedules = (int) $lines[0];

        // Remove the first element, the number of schedules. We don't need it anymore.
        unset($lines[0]);

        // Reset the indexing
        $lines = array_values($lines);

        return $lines;
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
    private function extractDataFromLines(array $lines): void
    {
        foreach ($lines as $line) {

            $this->extractTurnaroundTime($line);
            $this->extractNumberOfTrips($line);
            $this->extractTimes($line);
        }
    }

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

    private function extractTimes(string $line)
    {
        // This is the last extractor. 
        if ($this->isDepartureArrivalTime($line)) {
            $times = explode(' ', $line);
            $departureTime = $times[0];
            $arrivalTime = $times[1];

            // If the number of trips from A to B is not reached yet, add the trip to the tripsAb array.
            if ($this->numberOfTripsAb > 0) {
                $this->extractAbTimes($departureTime, $arrivalTime);
            } elseif ($this->numberOfTripsBa > 0) {
                $this->extractBaTimes($departureTime, $arrivalTime);
            } else {
                throw new BaseException('Error while extracting times.');
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

    private function extractAbTimes(string $departureTime, string $arrivalTime)
    {
        $this->tripsAb[] = new TripAb(
            $this->turnaroundTime, 
            $departureTime, 
            $arrivalTime
        );
        $this->numberOfTripsAb--;
    }

    private function extractBaTimes(string $departureTime, string $arrivalTime)
    {
        $this->tripsBa[] = new TripBa(
            $this->turnaroundTime, 
            $departureTime, 
            $arrivalTime
        );
        $this->numberOfTripsBa--;
    }

    private function createSchedule()
    {
        $schedule = new Schedule(
            $this->turnaroundTime,
            $this->tripsAb,
            $this->tripsBa
        );
    }

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