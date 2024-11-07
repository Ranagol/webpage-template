<?php

namespace App\trains\input;

class TimeTableCase {
    
    private int $turnaroundTime;

    private int $numberOfTripsAtoB;

    private int $numberOfTripsBtoA;

    private array $tripTimesAtoB;

    private array $tripTimesBtoA;
}