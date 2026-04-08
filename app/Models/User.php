<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * These lines below are demanded by phpstan, because it doesn't understand the magic methods of Eloquent.
 * Do not delete them.
 *
 * @property int    $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 *
 * @method static User|null                             find(mixed $id, array<int, string> $columns = ['*'])
 * @method static User                                  findOrFail(mixed $id, array<int, string> $columns = ['*'])
 * @method static User                                  create(array<string, mixed> $attributes = [])
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
     * The session superglobal contains the logged in user's id, so if a
     * user is logged in, we can get his id from the session superglobal.
     */
    public static function getCurrentUser(): ?User
    {
        if (isset($_SESSION) && isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $user = User::find($userId);

            return $user;
        }

        return null;
    }
}
