<?php

declare(strict_types=1);

namespace Tests\App\Exceptions;

use App\Exceptions\BaseException;
use App\Exceptions\ScheduleMakerException;
use PHPUnit\Framework\TestCase;

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
