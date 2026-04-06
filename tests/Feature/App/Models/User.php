<?php

namespace App\Models;

class User {

    public string $email;

    public static function getCurrentUser(): User

    {
        $user = new User();
        $user->email = 'testuser@example.com';
        return $user;
    }
}