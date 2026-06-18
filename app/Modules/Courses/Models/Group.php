<?php

namespace App\Modules\Courses\Models;

use App\Modules\Courses\Models\Course;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Modules\Courses\Database\Factories\ClassFactory;

class Group extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'course_id',
        'user_id',
    ];

    // protected static function newFactory(): ClassFactory
    // {
    //     // return ClassFactory::new();
    // }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
