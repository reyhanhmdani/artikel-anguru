<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $table = 'biographies';
    protected $fillable = [
        'name',
        'birth_place',
        'birth_date',
        'profile_picture',
        'short_bio',
        'long_bio',
        'achievements',
        'social_media',
    ];
}
