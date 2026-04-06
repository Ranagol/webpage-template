<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Application;
use App\Controllers\UploadDownloadCsv\DownloadController;

final class DownloadControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Application::bootstrap();
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
    }

    public function testDownloadRejectsInvalidCsrf(): void
    {
        $_SESSION['username'] = 'testuser';
        $_SESSION['csrf_token'] = 'valid_csrf_token';
        $request = $this->createMock(\System\request\RequestInterface::class);
        $request->method('getAllRequestData')->willReturn([
            'csrf_token' => 'invalid_csrf_token',
            'downloadRequest' => ['Category' => 100],
        ]);
        $controller = new DownloadController();
        ob_start();
        $controller->download($request);
        $output = ob_get_clean();
        $this->assertStringContainsString('Invalid CSRF token.', $output);
    }

    public function testDownloadRejectsInvalidDownloadRequest(): void
    {
        $_SESSION['username'] = 'testuser';
        $_SESSION['csrf_token'] = 'valid_csrf_token';
        $request = $this->createMock(\System\request\RequestInterface::class);
        $request->method('getAllRequestData')->willReturn([
            'csrf_token' => 'valid_csrf_token',
            'downloadRequest' => null,
        ]);
        $controller = new DownloadController();
        ob_start();
        $controller->download($request);
        $output = ob_get_clean();
        $this->assertStringContainsString('Invalid download request.', $output);
    }

    public function testDownloadSendsCsvResponse(): void
    {
        $_SESSION['username'] = 'testuser';
        $_SESSION['csrf_token'] = 'valid_csrf_token';
        $data = [
            'Food' => 42.5,
            'Fuel' => 12.3,
        ];
        $request = $this->createMock(\System\request\RequestInterface::class);
        $request->method('getAllRequestData')->willReturn([
            'csrf_token' => 'valid_csrf_token',
            'downloadRequest' => $data,
        ]);
        $controller = new DownloadController();
        ob_start();
        $controller->download($request);
        $output = ob_get_clean();
        $this->assertStringContainsString('Category,Cost', $output);
        $this->assertStringContainsString('Food,42.5', $output);
        $this->assertStringContainsString('Fuel,12.3', $output);
    }
}