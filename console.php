<?php
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\console\HelloCommand;

// Create a new Symfony Console application
$application = new Application();

// Register commands here
$application->add(new HelloCommand());

// Run the console application
$application->run();