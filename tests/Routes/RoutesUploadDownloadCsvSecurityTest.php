<?php

declare(strict_types=1);

namespace Tests\Routes;

use PHPUnit\Framework\TestCase;

final class RoutesUploadDownloadCsvSecurityTest extends TestCase
{
    public function testDownloadReportRouteIsPostOnly(): void
    {
        $routesFile = __DIR__ . '/../../routes/routesUploadDownloadCsv.php';
        $contents = file_get_contents($routesFile);

        $this->assertIsString($contents);
        $this->assertStringContainsString('$router->post(\'/download-report\'', $contents);
        $this->assertStringNotContainsString('$router->get(\'/download-report\'', $contents);
    }
}
