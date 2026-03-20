<?php

namespace Tests\App\Validators;

use App\Validators\LoginValidator;
use PHPUnit\Framework\TestCase;
use App\Exceptions\ValidationException;

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
}
