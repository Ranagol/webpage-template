<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;

// Using the create() method.Carbon::create() may be slightly faster for known, consistent date formats, as it doesn't need to parse the input string
$dateTime = CarbonImmutable::create('2021-01-01 00:00:00');

//This is how we can get the actual date time string from the Carbon object
$dateTime->toDateTimeString(); // 2021-01-01 00:00:00

$newDateTime = $create->addDays(1); // 2021-01-02 00:00:00

// We want to format the $newDateTime to be 02.01.2021 
$newDateTime->format('d.m.Y'); // 02.01.2021
