<?php

namespace Tests\App\Console;

use PHPUnit\Framework\TestCase;
use App\Console\HelloCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class HelloCommandTest extends TestCase
{
    public function testHelloCommandExecutesSuccessfully(): void
    {
        $command = new HelloCommand();
        $tester = new CommandTester($command);

        $exitCode = $tester->execute([]);
        $output = $tester->getDisplay();

        $this->assertSame('hello', $command->getName());
        $this->assertSame(Command::SUCCESS, $exitCode);
        $this->assertStringContainsString('Hello, World! Command was executed!', $output);
    }
}
