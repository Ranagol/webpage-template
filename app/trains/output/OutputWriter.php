<?php

namespace App\trains\output;

class OutputWriter
{
    /**
     * Contains full schedules with the number of trains needed. All data is here
     *
     * @var array
     */
    private array $schedules = [];

    /**
     * Contains the outputs in a string. One string output for every schedule. This is what will be
     * displayed on the console screen.
     *
     * @var array
     */
    private array $outputs = [];
    
    /**
     * Returns an array, that contains the output in a string. One string output for every schedule.
     *
     * @param array $schedules
     * @return array
     */
    public function makeResponse(array $schedules)
    {
        $this->schedules = $schedules;

        $caseNumber = 1;


        foreach ($this->schedules as $schedule) {
            $numberOfTrainsA = $schedule->getNumberOfTrainsA();
            $numberOfTrainsB = $schedule->getNumberOfTrainsB();

            $output = 'Case #'  . $caseNumber . ': ' . $numberOfTrainsA . ' ' . $numberOfTrainsB;
            $this->outputs[] = $output;
            $caseNumber++;
        }

        return $this->outputs;
    }
}