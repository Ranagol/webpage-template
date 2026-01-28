<?php

namespace App\Trains\Input;


/**
 * Converts a a string that contains all the train timetable data into an array of lines that 
 * - again - contain the train timetable data.
 */
class StringToLinesConverter
{
    public function transformStringToLines(string $taskData): array
    {
        // Split the string into an array of lines
        $lines = explode(PHP_EOL, $taskData);

        // Process each line
        foreach ($lines as $line) {
            // Trim any leading or trailing whitespace
            $line = trim($line);

            $formattedLines[] = $line;
        }
        
        /**
         * For some reason there is a strange line at the end, we need to remove this. We do this 
         * with array_pop. The array is modified in place, so we don't need to assign the result to
         * a new variable. Most likely this is a newline character for the end of the file.
         */
        array_pop($formattedLines);

        return $formattedLines;
    }
}