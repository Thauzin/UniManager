<?php

namespace App\Modules\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Modules\Courses\Database\Factories\CourseFactory;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'workload',
        'course_area_id',
    ];

    // public function course_area()
    // {
    //     return $this->belongsTo(CourseArea::class);
    // }
}
