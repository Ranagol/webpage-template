<?php

namespace App\trains\input;

use TimeTableCase;

/**
 * This class will create cases from the input lines.
 * Here is a sample:
 * 2
 * 5
 * 3 2
 * 09:00 12:00
 * 10:00 13:00
 * 11:00 12:30
 * 12:02 15:00
 * 09:00 10:30
 * 2
 * 2 0
 * 09:00 09:01
 * 12:00 12:02
 */
class CaseMaker {

    private int $numberOfCases;

    public function makeCases(array $lines)
    {
        $this->setNumberOfCases($lines);
        
    }

    private function setNumberOfCases(array $lines): void
    {
        $this->numberOfCases = (int) $lines[0];

        // Remove the first element from the array, which is the number of cases. We don't need it anymore.
        array_pop($lines);
    }

    private function inspectLines(array $lines): void
    {
        foreach ($lines as $line) {
            
        }
    }


}