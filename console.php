<?php
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\console\HelloCommand;
use App\console\TrainCommand;

// Create a new Symfony Console application
$application = new Application();

// This is where we register our custom commands. 
$application->add(new HelloCommand());
$application->add(new TrainCommand());

// Run the console application
$application->run();