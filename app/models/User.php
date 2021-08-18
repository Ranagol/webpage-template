<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Exception;

class User extends Model
{
    protected $guarded = [];

    /**
     * Returns the current logged in user.
     * The session supergolbal contains the logged in user's id, so if a 
     * user is logged in, we can get his id from the session superglobal.
     *
     * @return void
     */
    public static function getCurrentUser()
    {
        try {
            if (isset($_SESSION)) {
                $userId = $_SESSION['id'];
                $user = User::findOrFail($userId);
    
                return $user;
            } 
            throw new Exception('User is not logged in.');
        } catch (Exception $error) {
            echo $error->getMessage();
            redirect('/login');
        }

        return false;
    }
}
