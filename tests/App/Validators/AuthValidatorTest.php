<?php

namespace Tests\App\Validators;

use App\Validators\AuthValidator;
use PHPUnit\Framework\TestCase;

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
