<?php

namespace App\Trains\Output;

class OutputWriter
{
    /**
     * Returns an array, that contains the outputs in a string. One string output for every schedule.
     *
     * @param array $schedules  Contains full schedules with the number of trains needed. All data is here. The number of trains too.
     * @return array
     */
    public function makeResponse(array $schedules)
    {
        /**
         * Contains the outputs in a string. One string output for every schedule. This is what will be
         * displayed on the console screen.
         *
         */
        $outputs = [];

        /**
         * This is the initial case number, which will be used in the terminal. Example:
         * Case #1: 2 2
         * Case #2: 2 0
         */
        $caseNumber = 1;

        /**
         * We must loop through every schedule, and prepare the result or response for displaying in
         * the terminal.
         */
        foreach ($schedules as $schedule) {

            /**
             * We are getting the initial number of trains needed for every schedule, for station A and B.
             */
            $numberOfTrainsA = $schedule->getNumberOfTrainsA();
            $numberOfTrainsB = $schedule->getNumberOfTrainsB();

            // This will be displayed in the terminal, for every schedule.
            $output = 'Case #'  . $caseNumber . ': ' . $numberOfTrainsA . ' ' . $numberOfTrainsB;
            
            $outputs[] = $output;
            $caseNumber++;
        }

        return $outputs;
    }
}