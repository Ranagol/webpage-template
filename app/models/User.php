<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];

    public static function getCurrentUser()
    {
        if (isset($_SESSION)) {
            $userId = $_SESSION['id'];
            $user = User::findOrFail($userId);

            return $user;
        } 
        echo 'There is no logged in user.';

        return false;
    }
}
