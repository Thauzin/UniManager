<?php

namespace App\Modules\SecretaryRequests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Modules\SecretaryRequests\Database\Factories\SecretaryRequestFactory;

class SecretaryRequest extends Model
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

    // protected static function newFactory(): SecretaryRequestFactory
    // {
    //     // return SecretaryRequestFactory::new();
    // }
}
