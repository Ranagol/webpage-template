<?php

namespace App\Trains\Input;

/**
 * We use CarbonImmutable, because we do not want to alow the change of the departure and arrival times,
 * when we are adding or comparing these times. If we would use Carbon only, then we could unintentionally
 * change the departure and arrival times.
 */
use Carbon\CarbonImmutable;

class Train
{
    /**
     * Sometimes a train can be reused for another trip. This is a flag for that. If a train arrives
     * to A station at 10:00, and the next trip starts at 10:30 from station A, then this train can be reused for the
     * next trip. But, if there is another, third trip from station A, lets say at 12:00, then for this time
     * this train can't be reused again, since it is reused already for the 10:30 trip.
     *
     * @var boolean
     */
    private bool $isReused = false;
    
    /**
     * Train turnaround time in minutes
     *
     * @var float
     */
    private float $turnaroundTime;

    /**
     * Departure time. The hour and minute values are both two digits, zero-padded, and are on a 
     * 24-hour clock (00:00 through 23:59). Every time is on the same day. Because of this, we can
     * use any default date for the CarbonImmutable object. Since only the hours and the minutes matter.
     *
     * @var CarbonImmutable
     */
    private CarbonImmutable $departureTime;

    /**
     * Arrival time
     *
     * @var CarbonImmutable
     */
    private CarbonImmutable $arrivalTime;

    public function __construct(
        float $turnaroundTime, 
        string $departureTime, 
        string $arrivalTime
    )
    {
        $this->turnaroundTime = $turnaroundTime;
        $this->departureTime = CarbonImmutable::createFromFormat('H:i', $departureTime);
        $this->arrivalTime = CarbonImmutable::createFromFormat('H:i', $arrivalTime);
    }

    /**
     * Get the sum of turnaroundTime + arrivalTime.
     * 
     * @return  float
     */
    public function getArrivalTurnaroundSum(): CarbonImmutable
    {
        return $this->arrivalTime->addMinutes($this->turnaroundTime);
    }

    /**
     * Get the value of departureTime
     * 
     * @return  CarbonImmutable
     */ 
    public function getDepartureTime(): CarbonImmutable
    {
        return $this->departureTime;
    }

    /**
     * Get the value of arrivalTime
     * 
     * @return  CarbonImmutable
     */
    public function getArrivalTime(): CarbonImmutable
    {
        return $this->arrivalTime;
    }

    /**
     * Get the value of isReused
     * 
     * @return  bool
     */ 
    public function getIsReused(): bool
    {
        return $this->isReused;
    }

    /**
     * Set the value of isReused
     *
     * @return  void
     */ 
    public function setIsReused($isReused): void
    {
        $this->isReused = $isReused;
    }
}


