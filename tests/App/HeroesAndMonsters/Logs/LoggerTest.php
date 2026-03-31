<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Logs\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    protected function setUp(): void
    {
        // Reset Logger events for isolation
        $ref = new \ReflectionClass(Logger::class);
        $eventsProp = $ref->getProperty('events');
        $eventsProp->setAccessible(true);
        $eventsProp->setValue([]);
    }

    public function testLoggerSingleton(): void
    {
        $logger1 = Logger::getInstance();
        $logger2 = Logger::getInstance();
        $this->assertSame($logger1, $logger2);
    }

    public function testLogAndGetEvents(): void
    {
        $logger = Logger::getInstance();
        $logger->log('Event 1');
        $logger->log('Event 2');
        $events = $logger->getEvents();
        $this->assertCount(2, $events);
        $this->assertEquals(['Event 1', 'Event 2'], $events);
    }

    public function testEventsSharedAcrossSingleton(): void
    {
        $logger1 = Logger::getInstance();
        $logger2 = Logger::getInstance();
        $logger1->log('Shared Event');
        $this->assertEquals(['Shared Event'], $logger2->getEvents());
    }
}
