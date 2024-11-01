<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function calculcateAverageGrade(): float
    {
        $grades = $this->grades;

        if (empty($grades)) {
            return 0;
        }

        $sum = array_sum($grades);
        $count = count($grades);
        $averageGrade = $sum / $count;

        return $averageGrade;
    }
}
