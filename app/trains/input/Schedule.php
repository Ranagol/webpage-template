<?php

namespace App\trains\input;

class Schedule {
    
    private float $turnaroundTime;

    private array $tripsAtoB;

    private array $tripsBtoA;

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
}