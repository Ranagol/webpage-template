<?php

declare(strict_types=1);

namespace Tests\System\Request;

use PHPUnit\Framework\TestCase;
use System\request\WebPageRequest;

final class WebPageRequestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $_POST = [];
        $_REQUEST = [];
    }

    public function testWebPageRequestReadsOnlyPostData(): void
    {
        $_POST = [
            'email' => 'from-post@example.com',
            'password' => 'safe-password',
        ];

        $_REQUEST = [
            'email' => 'from-request@example.com',
            'password' => 'request-password',
        ];

        $request = new WebPageRequest();

        $this->assertSame('from-post@example.com', $request->get('email'));
        $this->assertSame('safe-password', $request->get('password'));
    }

    public function testWebPageRequestDoesNotFallbackToRequest(): void
    {
        $_POST = [];
        $_REQUEST = [
            'email' => 'injected@example.com',
        ];

        $request = new WebPageRequest();

        $this->assertSame([], $request->getAllRequestData());
    }
}
