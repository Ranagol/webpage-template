<?php

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\Price;
use PHPUnit\Framework\TestCase;

final class PriceTest extends TestCase
{
    public function testPriceGetterAndSetter(): void
    {
        $price = new Price(3.5);

        $this->assertSame(3.5, $price->getPrice());

        $price->setPrice(7.25);

        $this->assertSame(7.25, $price->getPrice());
    }
}
