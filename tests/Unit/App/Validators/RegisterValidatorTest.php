<?php

declare(strict_types=1);

namespace Tests\App\Validators;

use App\Exceptions\ValidationException;
use App\Validators\RegisterValidator;
use PHPUnit\Framework\TestCase;

final class RegisterValidatorTest extends TestCase
{
    private RegisterValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new RegisterValidator();
    }

    // -------------------------------------------------------------------------
    // Username validation
    // -------------------------------------------------------------------------

    public function testEmptyUsernameThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'password123', '', 'John', 'Doe');
    }

    public function testUsernameTooShortThrowsValidationException(): void
    {
        // Arrange — exactly 2 characters, rule is "longer than 2"
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'password123', 'ab', 'John', 'Doe');
    }

    public function testUsernameErrorKeyIsPresent(): void
    {
        try {
            $this->validator->validate('u@e.com', 'password123', '', 'John', 'Doe');
            $this->fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('usernameError', $e->getErrors());
        }
    }

    public function testEmptyFirstnameThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'password123', 'john', '', 'Doe');
    }

    public function testFirstnameTooShortThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'password123', 'john', 'Jo', 'Doe');
    }

    public function testFirstnameErrorKeyIsPresent(): void
    {
        try {
            $this->validator->validate('u@e.com', 'password123', 'john', '', 'Doe');
            $this->fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('firstnameError', $e->getErrors());
        }
    }

    public function testEmptyLastnameThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'password123', 'john', 'John', '');
    }

    public function testLastnameTooShortThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'password123', 'john', 'John', 'Do');
    }

    public function testInvalidEmailThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('not-an-email', 'password123', 'john', 'John', 'Doe');
    }

    public function testTooLongEmailThrowsValidationException(): void
    {
        $email = str_repeat('a', 245) . '@test.com'; // > 254 chars
        $this->expectException(ValidationException::class);
        $this->validator->validate($email, 'password123', 'john', 'John', 'Doe');
    }

    public function testEmptyPasswordThrowsValidationException(): void
    {
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', '', 'john', 'John', 'Doe');
    }

    public function testPasswordShorterThanEightCharsThrowsValidationException(): void
    {
        // Arrange — 7 characters, password strength requires >= 8
        $this->expectException(ValidationException::class);
        $this->validator->validate('u@e.com', 'short7!', 'john', 'John', 'Doe');
    }

    public function testPasswordExactlyEightCharsPassesStrengthCheck(): void
    {
        // Arrange — exactly 8 characters: boundary value
        $this->validator->validate('u@e.com', 'exactly8', 'john', 'John', 'Doe');
        $this->assertTrue(true);
    }

    public function testPasswordErrorKeyIsPresent(): void
    {
        try {
            $this->validator->validate('u@e.com', '', 'john', 'John', 'Doe');
            $this->fail('Expected ValidationException was not thrown.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('passwordError', $e->getErrors());
        }
    }
}
