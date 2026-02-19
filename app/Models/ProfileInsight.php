<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileInsight extends Model
{
    protected $fillable = [
        'profile_id',
        'insight_json',
        'version'
    ];

    protected $casts = [
        'insight_json' => 'array'
    ];
}
