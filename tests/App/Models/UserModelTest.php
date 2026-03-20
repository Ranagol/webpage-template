<?php

namespace Tests\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

final class UserModelTest extends TestCase
{
    public function testUserModelStructureAndHelpers(): void
    {
        $user = new User();

        $this->assertInstanceOf(Model::class, $user);
        $this->assertContains('id', $user->getGuarded());
        $this->assertContains('password', $user->getHidden());
        $this->assertContains('getCurrentUser', get_class_methods(User::class));
    }
}
