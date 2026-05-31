<?php

namespace App\Modules\StudentRequests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Modules\StudentRequests\Database\Factories\StudentRequestFactory;

class StudentRequest extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'description',
        'status'
    ];

    // protected static function newFactory(): StudentRequestFactory
    // {
    //     // return StudentRequestFactory::new();
    // }
}
