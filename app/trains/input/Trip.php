<?php

namespace App\Trains\Input;

use Carbon\Carbon;

class Trip
{
    /**
     * Train turnaround time in minutes
     *
     * @var float
     */
    private float $turnaroundTime;

    /**
     * Departure time. The hour and minute values are both two digits, zero-padded, and are on a 
     * 24-hour clock (00:00 through 23:59). Every time is on the same day. Because of this, we can
     * use any default date for the Carbon object. Since only the hours and the minutes matter.
     *
     * @var Carbon
     */
    private Carbon $departureTime;

    /**
     * Arrival time
     *
     * @var Carbon
     */
    private Carbon $arrivalTime;

    public function __construct(
        float $turnaroundTime, 
        string $departureTime, 
        string $arrivalTime
    )
    {
        $this->turnaroundTime = $turnaroundTime;
        $this->departureTime = Carbon::createFromFormat('H:i', $departureTime);
        $this->arrivalTime = Carbon::createFromFormat('H:i', $arrivalTime);
    }
}


