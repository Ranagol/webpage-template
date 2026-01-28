<?php
namespace App\console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    // Configure the command
    protected static $defaultName = 'hello';

    protected function configure()
    {
        $this
            ->setDescription('Says Hello')
            ->setHelp('This command allows you to say Hello');
    }

    // Execute the command
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello, World! Command was executed!');
        return Command::SUCCESS;
    }
}