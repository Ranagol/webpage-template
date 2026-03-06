<?php

namespace Tests\App\Console;

use PHPUnit\Framework\TestCase;
use App\Console\TrainCommand;

final class TrainCommandTest extends TestCase
{
    public function testTrainCommandMetadataIsConfigured(): void
    {
        $command = new TrainCommand();

        $this->assertSame('trains', $command->getName());
        $this->assertStringContainsString('Solves the trains problem', $command->getDescription());
        $this->assertStringContainsString('solve the trains problem', $command->getHelp());
    }
}
