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

    // Execute the command
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $trainService = new TrainService();
        $trainService->handle();

        $output->writeln('Command was executed, see the STDOUT file for the output');
        return Command::SUCCESS;
    }
}