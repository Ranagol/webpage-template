<?php

namespace Tests\App\Validators;

use PHPUnit\Framework\TestCase;
use App\Validators\AuthValidator;

final class AuthValidatorTest extends TestCase
{
    public function testAuthValidatorIsAbstractBaseClass(): void
    {
        $reflection = new \ReflectionClass(AuthValidator::class);

        $this->assertTrue($reflection->isAbstract());
        $this->assertTrue($reflection->hasMethod('validateEmail'));
        $this->assertTrue($reflection->hasMethod('validatePassword'));
    }
}
