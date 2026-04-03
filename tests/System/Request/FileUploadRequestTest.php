<?php

declare(strict_types=1);

namespace Tests\System\Request;

use PHPUnit\Framework\TestCase;
use System\request\FileUploadRequest;

final class FileUploadRequestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $_FILES = [];
        $_POST = [];
    }

    public function testFileUploadRequestContainsFileAndCsrfToken(): void
    {
        $_FILES['file'] = [
            'name' => 'report.csv',
            'type' => 'text/csv',
            'tmp_name' => '/tmp/php123',
            'error' => 0,
            'size' => 123,
        ];
        $_POST['csrf_token'] = 'token-123';

        $request = new FileUploadRequest();
        $payload = $request->getAllRequestData();

        $this->assertArrayHasKey('file', $payload);
        $this->assertArrayHasKey('csrf_token', $payload);
        $this->assertSame('report.csv', $payload['file']['name']);
        $this->assertSame('token-123', $payload['csrf_token']);
    }
}
