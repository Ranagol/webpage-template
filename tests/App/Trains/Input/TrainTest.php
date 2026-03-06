<?php

namespace Tests\App\Trains\Input;

require_once dirname(__DIR__) . '/TrainsClassLoader.php';

use App\Trains\Input\Train;
use PHPUnit\Framework\TestCase;

final class TrainTest extends TestCase
{
    public function testTrainTimesAndReuseFlag(): void
    {
        $train = new Train(5, '09:00', '09:20');

        $this->assertSame('09:00', $train->getDepartureTime()->format('H:i'));
        $this->assertSame('09:20', $train->getArrivalTime()->format('H:i'));
        $this->assertSame('09:25', $train->getArrivalTurnaroundSum()->format('H:i'));
        $this->assertFalse($train->getIsReused());

        $train->setIsReused(true);

        $this->assertTrue($train->getIsReused());
    }
}
