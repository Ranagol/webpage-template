<?php

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\CsvFile;
use App\Report\ReportDomain\Reportable;
use PHPUnit\Framework\TestCase;

final class ReportableTest extends TestCase
{
    public function testCsvFileImplementsReportable(): void
    {
        $this->assertTrue(interface_exists(Reportable::class));
        $this->assertContains(Reportable::class, class_implements(CsvFile::class));
    }
}
