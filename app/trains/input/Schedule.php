<?php

namespace App\trains\input;

class Schedule {

    /**
     * The turnaround time in minutes. It is the time needed for the train to be prepared for the next trip,
     * back to the station where it initially came.
     *
     * @var float
     */
    private float $turnaroundTime;

    /**
     * Contains all TripAtoB objects in an array, that belong to this schedule.
     *
     * @var array
     */
    private array $tripsAtoB;

    /**
     * Contains all TripBtoA objects in an array, that belong to this schedule.
     *
     * @var array
     */
    private array $tripsBtoA;

    /**
     * Number of trains initally needed at the start of the day, at the station A. It is equal to the
     * number of trips from A to B. This is a bit maybe redundant here, but it helps understanding
     * the logic.
     *
     * @var integer
     */
    private int $numberOfTrainsA = 0;

    /**
     * Number of trains initally needed at the start of the day, at the station B. It is equal to the
     * number of trips from B to A. This is a bit maybe redundant here, but it helps understanding
     * the logic.
     *
     * @var integer
     */
    private int $numberOfTrainsB = 0;

    public function __construct(
        float $turnaroundTime, 
        array $tripsAtoB, 
        array $tripsBtoA
    )
    {
        $this->turnaroundTime = $turnaroundTime;
        $this->tripsAtoB = $tripsAtoB;
        $this->tripsBtoA = $tripsBtoA;
        $this->numberOfTrainsA = (count($tripsAtoB));
        $this->numberOfTrainsB = (count($tripsBtoA));
    }

    /**
     * Get the value of tripsAtoB
     */ 
    public function getTripsAtoB(): array
    {
        return $this->tripsAtoB;
    }

    /**
     * Get the value of tripsBtoA
     */ 
    public function getTripsBtoA(): array
    {
        return $this->tripsBtoA;
    }

    /**
     * Set the value of numberOfTrainsA
     *
     * @param int $number
     * @return  void
     */ 
    public function reduceNumberOfTrainsInA(int $number): void
    {
        $this->numberOfTrainsA = $this->numberOfTrainsA - $number;
    }

    /**
     * Set the value of numberOfTrainsB
     *
     * @param int $number
     * @return  void
     */ 
    public function reduceNumberOfTrainsInB(int $number): void
    {
        $this->numberOfTrainsB = $this->numberOfTrainsB - $number;
    }

    /**
     * Get the value of numberOfTrainsA
     * 
     * @return int
     */ 
    public function getNumberOfTrainsA(): int
    {
        return $this->numberOfTrainsA;
    }

    /**
     * Get the value of numberOfTrainsB
     * 
     * @return int
     */ 
    public function getNumberOfTrainsB(): int
    {
        return $this->numberOfTrainsB;
    }
}