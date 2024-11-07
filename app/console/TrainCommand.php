<?php
namespace App\console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\trains\TrainService;

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
     * cat app/trains/trainTimetable | php console.php trains
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
        $trainTimetable = stream_get_contents(STDIN);

        if (!$trainTimetable) {
            $output->writeln("No input file provided");
            return Command::FAILURE;
        }


        $trainService = new TrainService();
        $trainService->handle($trainTimetable);

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

