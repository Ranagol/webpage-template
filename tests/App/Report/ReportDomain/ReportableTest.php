<?php

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\CsvFile;
use PHPUnit\Framework\TestCase;
use App\Report\ReportDomain\Reportable;

final class ReportableTest extends TestCase
{
    public function testCsvFileImplementsReportable(): void
    {
        $this->assertTrue(interface_exists(Reportable::class));
        $this->assertContains(Reportable::class, class_implements(CsvFile::class));
    }
}
