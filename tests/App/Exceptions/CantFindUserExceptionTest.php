<?php

declare(strict_types=1);

namespace Tests\App\Exceptions;

use App\Exceptions\BaseException;
use App\Exceptions\CantFindUserException;
use PHPUnit\Framework\TestCase;

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
