<?php
namespace App\Console;

use App\Trains\TrainService;
use App\Trains\Input\ScheduleMaker;
use App\Trains\Output\OutputWriter;
use App\Trains\Calculation\TrainCalculator;
use App\Trains\Input\StringToLinesConverter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TrainCommand extends Command
{
    // Configure the command
    protected static $defaultName = 'trains';

    protected function configure()
    {
        $this
            ->setDescription('Solves the trains problem')
            ->setHelp('This command allows you to solve the trains problem');
    }

    
    /**
     * Execute the command
     * 
     * Start the terminal in docker container: 
     * docker-compose exec -it php-container bash
     * 
     * Run the app and input the train timetable:
     *  - Below is the command for the original task data
     * cat app/trains/taskDataOriginal | php console.php trains
     * Expected output:
     * Case #1: 2 2
     * Case #2: 2 0
     * 
     *  - Below is the command for the big task data created by me
     * cat app/trains/taskDataBig | php console.php trains
     * Expected output:
     * Case #1: 2 2
     * Case #2: 2 0
     * Case #3: 2 2
     * Case #4: 2 0
     * Case #5: 2 2
     * Case #6: 2 0
     * Case #7: 2 2
     * Case #8: 2 0
     * 
     * - Below is the command for the double reusability problem by Losi
     * cat app/trains/taskDataWithLosiDoubleReusabilityProblem | php console.php trains
     * Expected output:
     * Case #1: 3 2
     * Case #2: 2 0
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Start measuring the execution time
        $startTime = microtime(true);

        //this will get everything, the whole data from STDIN
        $taskData = stream_get_contents(STDIN);

        if (!$taskData) {
            $output->writeln('No input file provided or input file is empty.');
            return Command::FAILURE;
        }

        // Instantiate dependencies
        $converter = new StringToLinesConverter();
        $scheduleMaker = new ScheduleMaker();
        $trainCalculator = new TrainCalculator();
        $outputWriter = new OutputWriter();

        // This is the main service that handles the logic, caclulates the initial number of trains
        $trainService = new TrainService(
            $converter,
            $scheduleMaker,
            $trainCalculator,
            $outputWriter
        );
        
        $responses = $trainService->handle($taskData);

        // Output the responses
        foreach ($responses as $result) {
            $output->writeln($result);
        }

        /**
         * Here we measure the max memory usage
         */
        // Get peak memory usage
        $peakMemoryUsage = memory_get_peak_usage(true); // true for real memory usage
        // Convert peak memory usage to a human-readable format
        $peakMemoryUsage = number_format($peakMemoryUsage / 1048576, 2) . ' MB';
        $output->writeln("Peak memory usage: $peakMemoryUsage");

        /**
         * Here we have the logic for execution time measuring and displaying in cli
         */
        // End measuring the execution time
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);
        // Format the elapsed time to 6 decimal places
        $executionTime = number_format($executionTime, 6);
        $output->writeln("Execution time: $executionTime seconds");

        $output->writeln('Command was executed!');
        return Command::SUCCESS;
    }
}

