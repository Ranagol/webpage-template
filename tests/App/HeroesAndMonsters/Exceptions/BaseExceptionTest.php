<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Exceptions\BaseException;
use PHPUnit\Framework\TestCase;

class BaseExceptionTest extends TestCase
{
    public function testBaseExceptionMessage(): void
    {
        $e = new BaseException('error', 123);
        $this->assertEquals('error', $e->getMessage());
        $this->assertEquals(123, $e->getCode());
    }
}
