<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    /**
     * The student grades are stored as a json in db. We must cast it to an array, this is what
     * the $casts property does.
     *
     * @var array
     */
    protected $casts = [
        'grades' => 'array',
    ];

    /**
     * We do not want to show the created_at and updated_at fields in the response.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Calculate the average grade of a student.
     *
     * @return float
     */
    public function calculcateAverageGrade(): float
    {
        $grades = $this->grades;

        $t = 8;//TODO ANDOR WHY XDEBUG DOES NOT WORK HERE????

        if (empty($grades)) {
            return 0;
        }

        $sum = array_sum($grades);
        $count = count($grades);
        $averageGrade = $sum / $count;

        return $averageGrade;
    }
}
