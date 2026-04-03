<?php

declare(strict_types=1);

namespace Tests\App\Validators;

use App\Exceptions\ValidationException;
use App\Validators\LoginValidator;
use PHPUnit\Framework\TestCase;

final class LoginValidatorTest extends TestCase
{
    public function testValidInputPassesValidation(): void
    {
        $validator = new LoginValidator();
        $validator->validate('test@example.com', 'secret123');

        $this->expectNotToPerformAssertions();
    }

    public function testInvalidInputThrowsValidationException(): void
    {
        $validator = new LoginValidator();

        try {
            $validator->validate('', '');
            $this->fail('ValidationException was not thrown for invalid login input.');
        } catch (ValidationException $exception) {
            $errors = json_decode($exception->getMessage(), true);

            $this->assertIsArray($errors);
            $this->assertArrayHasKey('emailError', $errors);
            $this->assertArrayHasKey('passwordError', $errors);
        }
    }

    public function testInvalidEmailFormatThrowsValidationException(): void
    {
        $validator = new LoginValidator();

        try {
            $validator->validate('invalid-email', 'secret123');
            $this->fail('ValidationException was not thrown for invalid email format.');
        } catch (ValidationException $exception) {
            $errors = json_decode($exception->getMessage(), true);

            $this->assertIsArray($errors);
            $this->assertArrayHasKey('emailError', $errors);
        }
    }
}
