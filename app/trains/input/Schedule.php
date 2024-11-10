<?php

namespace App\trains\input;

class Schedule {
    
    private float $turnaroundTime;

    private array $tripsAtoB;

    private array $tripsBtoA;

    private int $numberOfTrainsA = 0;

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
     * @param int $numberOfTrainsA
     * @return  void
     */ 
    public function setNumberOfTrainsA(int $numberOfTrainsA): void
    {
        $this->numberOfTrainsA = $numberOfTrainsA;
    }

    /**
     * Set the value of numberOfTrainsB
     *
     * @param int $numberOfTrainsB
     * @return  void
     */ 
    public function setNumberOfTrainsB(int $numberOfTrainsB): void
    {
        $this->numberOfTrainsB = $numberOfTrainsB;
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