<?php

require __DIR__ . '/vendor/autoload.php';

use App\Console\HelloCommand;
use App\Console\TrainCommand;
use Symfony\Component\Console\Application;

// Create a new Symfony Console application
$application = new Application();

// This is where we register our custom commands.
$application->add(new HelloCommand());
$application->add(new TrainCommand());

// Run the console application
$application->run();
