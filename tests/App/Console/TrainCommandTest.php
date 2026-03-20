<?php

declare(strict_types=1);

namespace Tests\App\Console;

use App\Console\TrainCommand;
use PHPUnit\Framework\TestCase;

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
