<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * Returns the current logged in user.
     * The session supergolbal contains the logged in user's id, so if a 
     * user is logged in, we can get his id from the session superglobal.
     *
     * @return User|bool
     */
    public static function getCurrentUser(): User|bool
    {
        if (isset($_SESSION)) {
            $userId = $_SESSION['id'];
            $user = User::findOrFail($userId);

            return $user;
        } 

        return false;
    }
}
