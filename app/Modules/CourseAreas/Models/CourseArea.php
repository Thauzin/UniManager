<?php

namespace App\Modules\CourseAreas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Modules\CourseAreas\Database\Factories\CourseAreaFactory;

class CourseArea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];

    // protected static function newFactory(): CourseAreaFactory
    // {
    //     // return CourseAreaFactory::new();
    // }
}
