<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @method static User|null find(mixed $id, array<int, string> $columns = ['*'])
 * @method static User findOrFail(mixed $id, array<int, string> $columns = ['*'])
 * @method static User create(array<string, mixed> $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder orderBy(string $column, string $direction = 'asc')
 */
class User extends Model
{
    protected $guarded = ['id'];

    /** @var array<int, string> */
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
