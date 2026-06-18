<?php

namespace App\Modules\Users\Models;

use App\Modules\AccessLevels\Models\AccessLevel;
use App\Modules\CourseAreas\Models\CourseArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Modules\Users\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'password',
        'username',
        'email',
        'access_level_id',
        'center_id',
        'authenticable_type',
        'authenticable_id',
        'active',
        'cpf',
        'phone',
        'course_area_id',
    ];
    
    public function getAuthIdentifierName()
    {
        return 'email';
    }
    
    protected $hidden = [
        'password',
    ];

    // public function authenticable()
    // {
    //     return $this->morphTo();
    // }

    public function access_level()
    {
        return $this->belongsTo(AccessLevel::class);
    }

    public function course_area()
    {
        return $this->belongsTo(CourseArea::class);
    }

}
