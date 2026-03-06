<?php

namespace Tests\App\Exceptions;

use PHPUnit\Framework\TestCase;
use App\Exceptions\BaseException;
use App\Exceptions\ScheduleMakerException;

final class ScheduleMakerExceptionTest extends TestCase
{
    public function testScheduleMakerExceptionExtendsBaseException(): void
    {
        $exception = new ScheduleMakerException('schedule-error', 500);

        $this->assertInstanceOf(BaseException::class, $exception);
        $this->assertSame('schedule-error', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
    }
}
