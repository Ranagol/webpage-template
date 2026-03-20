<?php

declare(strict_types=1);

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    // Configure the command
    protected static $defaultName = 'hello';

    protected function configure(): void
    {
        $this
            ->setDescription('Says Hello')
            ->setHelp('This command allows you to say Hello');
    }

    // Execute the command
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello, World! Command was executed!');

        return Command::SUCCESS;
    }
}
