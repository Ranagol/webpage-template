<?php

declare(strict_types=1);

namespace Domain\Trains\Input;

class Schedule
{
    /**
     * The turnaround time in minutes. It is the time needed for the train to be prepared for the next trip,
     * back to the station where it initially came.
     */
    private float $turnaroundTime;

    /**
     * Contains all TripAtoB objects in an array, that belong to this schedule.
     *
     * @var array<int, Train>
     */
    private array $trainsAtoB;

    /**
     * Contains all TripBtoA objects in an array, that belong to this schedule.
     *
     * @var array<int, Train>
     */
    private array $trainsBtoA;

    /**
     * Number of trains initally needed at the start of the day, at the station A. It is equal to the
     * number of trips from A to B. This is a bit maybe redundant here, but it helps understanding
     * the logic.
     */
    private int $numberOfTrainsInA = 0;

    /**
     * Number of trains initally needed at the start of the day, at the station B. It is equal to the
     * number of trips from B to A. This is a bit maybe redundant here, but it helps understanding
     * the logic.
     */
    private int $numberOfTrainsInB = 0;

    /**
     * @param array<int, Train> $trainsAtoB
     * @param array<int, Train> $trainsBtoA
     */
    public function __construct(
        float $turnaroundTime,
        array $trainsAtoB,
        array $trainsBtoA,
    ) {
        $this->turnaroundTime = $turnaroundTime;
        $this->trainsAtoB = $trainsAtoB;
        $this->trainsBtoA = $trainsBtoA;
        $this->numberOfTrainsInA = count($trainsAtoB);
        $this->numberOfTrainsInB = count($trainsBtoA);
    }

    /**
     * Get the value of trainsAtoB.
     *
     * @return array<int, Train>
     */
    public function getTripsAtoB(): array
    {
        return $this->trainsAtoB;
    }

    /**
     * Get the value of trainsBtoA.
     *
     * @return array<int, Train>
     */
    public function getTripsBtoA(): array
    {
        return $this->trainsBtoA;
    }

    /**
     * Get the value of turnaroundTime.
     */
    public function getTurnaroundTime(): float
    {
        return $this->turnaroundTime;
    }

    /**
     * Set the value of numberOfTrainsInA.
     */
    public function reduceNumberOfTrainsInA(int $number): void
    {
        $this->numberOfTrainsInA = $this->numberOfTrainsInA - $number;
    }

    /**
     * Set the value of numberOfTrainsInB.
     */
    public function reduceNumberOfTrainsInB(int $number): void
    {
        $this->numberOfTrainsInB = $this->numberOfTrainsInB - $number;
    }

    /**
     * Get the value of numberOfTrainsInA.
     */
    public function getNumberOfTrainsA(): int
    {
        return $this->numberOfTrainsInA;
    }

    /**
     * Get the value of numberOfTrainsInB.
     */
    public function getNumberOfTrainsB(): int
    {
        return $this->numberOfTrainsInB;
    }
}
