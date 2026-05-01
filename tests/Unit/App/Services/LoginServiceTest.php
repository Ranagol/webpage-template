<?php

declare(strict_types=1);

namespace Tests\App\Services;

use App\Models\User;
use App\Services\LoginService;
use App\Validators\LoginValidator;
use PHPUnit\Framework\TestCase;

final class LoginServiceTest extends TestCase
{
    private LoginService $service;

    protected function setUp(): void
    {
        $this->service = new LoginService(new LoginValidator());
    }

    /**
     * Builds a User stub with a bcrypt-hashed password without touching the database.
     */
    private function makeUser(string $email, string $plainPassword): User
    {
        $user = new User();
        $user->email = $email;
        $user->password = password_hash($plainPassword, PASSWORD_DEFAULT);

        return $user;
    }

    public function testAuthenticateUserReturnsTrueForMatchingCredentials(): void
    {
        // Arrange
        $email = 'alice@example.com';
        $password = 'correct_password';
        $user = $this->makeUser($email, $password);

        // Act
        $result = $this->service->authenticateUser($user, $email, $password);

        // Assert
        $this->assertTrue($result);
    }

    public function testAuthenticateUserReturnsFalseForWrongPassword(): void
    {
        // Arrange
        $email = 'alice@example.com';
        $user = $this->makeUser($email, 'correct_password');

        // Act
        $result = $this->service->authenticateUser($user, $email, 'wrong_password');

        // Assert
        $this->assertFalse($result);
    }

    public function testAuthenticateUserReturnsFalseForWrongEmail(): void
    {
        // Arrange
        $user = $this->makeUser('alice@example.com', 'correct_password');

        // Act — different email supplied
        $result = $this->service->authenticateUser($user, 'bob@example.com', 'correct_password');

        // Assert
        $this->assertFalse($result);
    }

    public function testAuthenticateUserReturnsFalseForBothWrongCredentials(): void
    {
        // Arrange
        $user = $this->makeUser('alice@example.com', 'correct_password');

        // Act
        $result = $this->service->authenticateUser($user, 'wrong@example.com', 'wrong_password');

        // Assert
        $this->assertFalse($result);
    }

    public function testAuthenticateUserIsCaseSensitiveForEmail(): void
    {
        // Arrange — stored email is lowercase; we supply uppercase
        $user = $this->makeUser('alice@example.com', 'password123');

        // Act
        $result = $this->service->authenticateUser($user, 'ALICE@EXAMPLE.COM', 'password123');

        // Assert — strict equality: uppercase does NOT match
        $this->assertFalse($result);
    }

    public function testAuthenticateUserSetsSessionDataOnSuccess(): void
    {
        // Arrange
        $email = 'alice@example.com';
        $password = 'correct_password';
        $user = $this->makeUser($email, $password);
        $user->id = 42;
        $user->username = 'alice';

        // Act
        $this->service->authenticateUser($user, $email, $password);

        // Assert — session is populated
        $this->assertTrue($_SESSION['loggedin']);
        $this->assertSame(42, $_SESSION['id']);
        $this->assertSame('alice', $_SESSION['username']);
    }
}
