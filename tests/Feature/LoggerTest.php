<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Exceptions\BaseException;
use App\Logger\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    public function testLoggerCanWriteToLogFile(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        // Get the logger instance and log a test message
        $logger = Logger::getInstance();

        // Make this log message unique, so we can easily find it in the log file
        $testMessage = 'This is a test log message.' . uniqid();
        $logger->log($testMessage);

        // Read the log file and check if the test message is present
        $logFilePath = __DIR__ . '/../../storage/logs/myLogs.txt';
        $this->assertFileExists($logFilePath, 'Log file was not created by the logger');

        $logContents = file_get_contents($logFilePath);
        $this->assertIsString($logContents);
        $this->assertStringContainsString($testMessage, $logContents);
    }

    public function testBaseExceptionTriggersLogger(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        // Trigger an exception that should be logged
        $uniqueId = uniqid();
        try {
            throw new BaseException('Test exception for logging ' . $uniqueId);
        } catch (BaseException $e) {
            // Exception is expected, do nothing, this should trigger the Logger to log.
        }

        // Read the log file and check if the exception message is present
        $logFilePath = __DIR__ . '/../../storage/logs/myLogs.txt';
        $this->assertFileExists($logFilePath, 'Log file was not created by the logger');

        $logContents = file_get_contents($logFilePath);
        $this->assertIsString($logContents);
        $this->assertStringContainsString('Test exception for logging ' . $uniqueId, $logContents);
    }
}
