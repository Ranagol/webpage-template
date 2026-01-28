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
    private array $trainsAtoB;

    /**
     * Contains all TripBtoA objects in an array, that belong to this schedule.
     *
     * @var array
     */
    private array $trainsBtoA;

    /**
     * Number of trains initally needed at the start of the day, at the station A. It is equal to the
     * number of trips from A to B. This is a bit maybe redundant here, but it helps understanding
     * the logic.
     *
     * @var integer
     */
    private int $numberOfTrainsInA = 0;

    /**
     * Number of trains initally needed at the start of the day, at the station B. It is equal to the
     * number of trips from B to A. This is a bit maybe redundant here, but it helps understanding
     * the logic.
     *
     * @var integer
     */
    private int $numberOfTrainsInB = 0;

    public function __construct(
        float $turnaroundTime, 
        array $trainsAtoB, 
        array $trainsBtoA
    )
    {
        $this->turnaroundTime = $turnaroundTime;
        $this->trainsAtoB = $trainsAtoB;
        $this->trainsBtoA = $trainsBtoA;
        $this->numberOfTrainsInA = (count($trainsAtoB));
        $this->numberOfTrainsInB = (count($trainsBtoA));
    }

    /**
     * Get the value of trainsAtoB
     */ 
    public function getTripsAtoB(): array
    {
        return $this->trainsAtoB;
    }

    /**
     * Get the value of trainsBtoA
     */ 
    public function getTripsBtoA(): array
    {
        return $this->trainsBtoA;
    }

    /**
     * Set the value of numberOfTrainsInA
     *
     * @param int $number
     * @return  void
     */ 
    public function reduceNumberOfTrainsInA(int $number): void
    {
        $this->numberOfTrainsInA = $this->numberOfTrainsInA - $number;
    }

    /**
     * Set the value of numberOfTrainsInB
     *
     * @param int $number
     * @return  void
     */ 
    public function reduceNumberOfTrainsInB(int $number): void
    {
        $this->numberOfTrainsInB = $this->numberOfTrainsInB - $number;
    }

    /**
     * Get the value of numberOfTrainsInA
     * 
     * @return int
     */ 
    public function getNumberOfTrainsA(): int
    {
        return $this->numberOfTrainsInA;
    }

    /**
     * Get the value of numberOfTrainsInB
     * 
     * @return int
     */ 
    public function getNumberOfTrainsB(): int
    {
        return $this->numberOfTrainsInB;
    }
}


