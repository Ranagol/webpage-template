<?php

namespace Tests\App\Exceptions;

use Exception;
use PHPUnit\Framework\TestCase;
use App\Exceptions\BaseException;

final class BaseExceptionTest extends TestCase
{
    public function testBaseExceptionExtendsExceptionAndKeepsPayload(): void
    {
        $exception = new BaseException('base-error', 422);

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertSame('base-error', $exception->getMessage());
        $this->assertSame(422, $exception->getCode());
    }
}
