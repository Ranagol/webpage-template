<?php

namespace Tests\App\Exceptions;

use PHPUnit\Framework\TestCase;
use App\Exceptions\BaseException;
use App\Exceptions\CantFindUserException;

final class CantFindUserExceptionTest extends TestCase
{
    public function testCantFindUserExceptionExtendsBaseException(): void
    {
        $exception = new CantFindUserException('user-not-found', 404);

        $this->assertInstanceOf(BaseException::class, $exception);
        $this->assertSame('user-not-found', $exception->getMessage());
        $this->assertSame(404, $exception->getCode());
    }
}
