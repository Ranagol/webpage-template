<?php

declare(strict_types=1);

namespace Tests\App\Exceptions;

use App\Exceptions\BaseException;
use App\Exceptions\ValidationException;
use PHPUnit\Framework\TestCase;

final class ValidationExceptionTest extends TestCase
{
    public function testValidationExceptionExtendsBaseException(): void
    {
        $exception = new ValidationException('validation-failed', 422);

        $this->assertInstanceOf(BaseException::class, $exception);
        $this->assertSame('validation-failed', $exception->getMessage());
        $this->assertSame(422, $exception->getCode());
    }
}
