<?php

namespace Tests\App\Exceptions;

use PHPUnit\Framework\TestCase;
use App\Exceptions\BaseException;
use App\Exceptions\ValidationException;

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
