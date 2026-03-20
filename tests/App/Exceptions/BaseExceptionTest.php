<?php

declare(strict_types=1);

namespace Tests\App\Exceptions;

use App\Exceptions\BaseException;
use PHPUnit\Framework\TestCase;

final class BaseExceptionTest extends TestCase
{
    public function testBaseExceptionExtendsExceptionAndKeepsPayload(): void
    {
        $exception = new BaseException('base-error', 422);

        $this->assertInstanceOf(\Exception::class, $exception);
        $this->assertSame('base-error', $exception->getMessage());
        $this->assertSame(422, $exception->getCode());
    }
}
