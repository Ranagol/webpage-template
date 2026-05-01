<?php

declare(strict_types=1);

namespace Tests\App\Services;

use App\Services\RegisterService;
use App\Validators\RegisterValidator;
use PHPUnit\Framework\TestCase;

final class RegisterServiceTest extends TestCase
{
    private RegisterService $service;

    protected function setUp(): void
    {
        $this->service = new RegisterService(new RegisterValidator());
    }

    public function testExtractDataFromRequestMapsFieldsToUserObject(): void
    {
        // Arrange
        $requestData = [
            'username' => 'johndoe',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'JOHN@EXAMPLE.COM',
            'password' => 'plainpassword',
        ];

        // Act
        $user = $this->service->extractDataFromRequest($requestData);

        // Assert
        $this->assertSame('johndoe', $user->username);
        $this->assertSame('John', $user->firstname);
        $this->assertSame('Doe', $user->lastname);
        $this->assertSame('john@example.com', $user->email); // lowercased
        $this->assertSame('plainpassword', $user->password);
    }

    public function testExtractDataFromRequestTrimsWhitespaceFromFields(): void
    {
        // Arrange
        $requestData = [
            'username' => '  alice  ',
            'firstname' => '  Alice  ',
            'lastname' => '  Smith  ',
            'email' => '  alice@example.com  ',
            'password' => 'pass123',
        ];

        // Act
        $user = $this->service->extractDataFromRequest($requestData);

        // Assert
        $this->assertSame('alice', $user->username);
        $this->assertSame('Alice', $user->firstname);
        $this->assertSame('Smith', $user->lastname);
        $this->assertSame('alice@example.com', $user->email);
    }

    public function testExtractDataFromRequestHandlesMissingKeysWithEmptyStrings(): void
    {
        // Arrange — all keys missing
        $requestData = [];

        // Act
        $user = $this->service->extractDataFromRequest($requestData);

        // Assert — defaults to empty strings
        $this->assertSame('', $user->username);
        $this->assertSame('', $user->firstname);
        $this->assertSame('', $user->lastname);
        $this->assertSame('', $user->email);
        $this->assertSame('', $user->password);
    }

    public function testExtractDataFromRequestConvertsEmailToLowercase(): void
    {
        // Arrange
        $requestData = ['email' => 'USER@DOMAIN.ORG', 'password' => 'pass'];

        // Act
        $user = $this->service->extractDataFromRequest($requestData);

        // Assert
        $this->assertSame('user@domain.org', $user->email);
    }
}
