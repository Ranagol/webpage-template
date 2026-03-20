<?php

namespace Tests\App\Validators;

use PHPUnit\Framework\TestCase;
use App\Validators\RegisterValidator;
use App\Exceptions\ValidationException;

final class RegisterValidatorTest extends TestCase
{
    public function testValidInputPassesValidation(): void
    {
        $validator = new RegisterValidator();
        $validator->validate('test@example.com', 'secret123', 'user123', 'John', 'Doe');

        $this->expectNotToPerformAssertions();
    }

    public function testInvalidInputThrowsValidationException(): void
    {
        $validator = new RegisterValidator();

        try {
            $validator->validate('', '', '', '', '');
            $this->fail('ValidationException was not thrown for invalid register input.');
        } catch (ValidationException $exception) {
            $errors = json_decode($exception->getMessage(), true);

            $this->assertIsArray($errors);
            $this->assertArrayHasKey('usernameError', $errors);
            $this->assertArrayHasKey('firstnameError', $errors);
            $this->assertArrayHasKey('lastNameError', $errors);
            $this->assertArrayHasKey('emailError', $errors);
            $this->assertArrayHasKey('passwordError', $errors);
        }
    }
}
