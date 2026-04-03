<?php

declare(strict_types=1);

namespace Tests\System\Request;

use PHPUnit\Framework\TestCase;
use System\request\FileDownloadRequest;

final class FileDownloadRequestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $_SESSION = [];
        $_POST = [];
    }

    public function testFileDownloadRequestContainsSessionReportAndCsrfToken(): void
    {
        $_SESSION['downloadRequest'] = ['Fuel' => 12.5];
        $_POST['csrf_token'] = 'token-xyz';

        $request = new FileDownloadRequest();
        $payload = $request->getAllRequestData();

        $this->assertSame(['Fuel' => 12.5], $payload['downloadRequest']);
        $this->assertSame('token-xyz', $payload['csrf_token']);
    }

    public function testFileDownloadRequestFallsBackToEmptyReportData(): void
    {
        $request = new FileDownloadRequest();
        $payload = $request->getAllRequestData();

        $this->assertSame([], $payload['downloadRequest']);
        $this->assertNull($payload['csrf_token']);
    }
}
