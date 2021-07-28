<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $guarded = [];//we do not guard here the table. Simply it is not guarded.

//   public function subjects () {//The department has a lot of subjectS...
//     return $this->hasMany(Subject::class);
//   }

}
