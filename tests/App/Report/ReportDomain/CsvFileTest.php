<?php

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\Line;
use App\Report\ReportDomain\Price;
use App\Report\ReportDomain\Amount;
use PHPUnit\Framework\TestCase;
use App\Report\ReportDomain\CsvFile;
use App\Report\ReportDomain\Category;

final class CsvFileTest extends TestCase
{
    public function testCsvFileBuildsMergedCategoryReport(): void
    {
        $lines = [
            new Line(new Category('food'), new Price(2), new Amount(3)),
            new Line(new Category('food'), new Price(1), new Amount(5)),
            new Line(new Category('travel'), new Price(3), new Amount(1)),
        ];

        $csvFile = new CsvFile('/tmp/input.csv', $lines);

        $this->assertSame('/tmp/input.csv', $csvFile->getPath());
        $this->assertCount(3, $csvFile->getLines());
        $this->assertSame(['food' => 11.0, 'travel' => 3.0], $csvFile->getReport());

        $csvFile->setPath('/tmp/other.csv');
        $this->assertSame('/tmp/other.csv', $csvFile->getPath());
    }
}
