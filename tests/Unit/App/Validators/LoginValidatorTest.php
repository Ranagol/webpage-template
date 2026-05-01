<?php

declare(strict_types=1);

namespace Tests\App\Validators;

use App\Exceptions\ValidationException;
use App\Validators\LoginValidator;
use PHPUnit\Framework\TestCase;

final class LoginValidatorTest extends TestCase
{
    private LoginValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new LoginValidator();
    }

    public function testEmptyEmailThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('', 'password123');
    }

    public function testEmptyPasswordThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('user@example.com', '');
    }

    public function testInvalidEmailFormatThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('not-an-email', 'password123');
    }

    public function testTooLongEmailThrowsValidationException(): void
    {
        // Arrange — > 254 chars
        $email = str_repeat('a', 245) . '@test.com';

        $this->expectException(ValidationException::class);
        $this->validator->validate($email, 'password123');
    }

    public function testPasswordTooShortThrowsValidationException(): void
    {
        // Arrange — exactly 2 characters is not longer than 2
        $this->expectException(ValidationException::class);
        $this->validator->validate('user@example.com', 'ab');
    }

    public function testValidationExceptionContainsEmailError(): void
    {
        try {
            $this->validator->validate('bad-email', 'password123');
            $this->fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('emailError', $e->getErrors());
        }
    }

    public function testValidationExceptionContainsPasswordError(): void
    {
        try {
            $this->validator->validate('user@example.com', '');
            $this->fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('passwordError', $e->getErrors());
        }
    }
}
