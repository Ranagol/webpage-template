<?php

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\Line;
use App\Report\ReportDomain\Price;
use App\Report\ReportDomain\Amount;
use PHPUnit\Framework\TestCase;
use App\Report\ReportDomain\Category;

final class LineTest extends TestCase
{
    public function testLineSumAndComponentGetters(): void
    {
        $category = new Category('office');
        $price = new Price(2.5);
        $amount = new Amount(4);
        $line = new Line($category, $price, $amount);

        $this->assertSame(10.0, $line->getLineSum());
        $this->assertSame($category, $line->getCategory());
        $this->assertSame($price, $line->getPrice());
        $this->assertSame($amount, $line->getAmount());
    }
}
