<?php

namespace Tests\App\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Model;

final class UserModelTest extends TestCase
{
    public function testUserModelStructureAndHelpers(): void
    {
        $user = new User();

        $this->assertInstanceOf(Model::class, $user);
        $this->assertContains('id', $user->getGuarded());
        $this->assertContains('password', $user->getHidden());
        $this->assertTrue(method_exists(User::class, 'getCurrentUser'));
    }
}
