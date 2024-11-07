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
     * cat app/trains/trainTimetable | php console.php trains
     * 
     * docker-compose exec -it php-container bash
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //this will get everything, the whole data from STDIN
        $trainTimetable = stream_get_contents(STDIN);

        if (!$trainTimetable) {
            $output->writeln("No input file provided");
            return Command::FAILURE;
        }

        // var_dump($trainTimetable);//This will show us all the data from the file

        $trainService = new TrainService($trainTimetable);
        $trainService->handle();

        $output->writeln('Command was executed!');
        return Command::SUCCESS;
    }
}