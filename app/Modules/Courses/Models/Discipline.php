<?php

namespace App\Modules\Courses\Models;

use App\Modules\Courses\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Modules\Courses\Database\Factories\DisciplineFactory;

class Discipline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name'
    ];

    // protected static function newFactory(): DisciplineFactory
    // {
    //     // return DisciplineFactory::new();
    // }

    public function course(){
        return $this->belongsToMany(Course::class);
    }
}
