<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostInsight extends Model
{
    protected $fillable = [
        'post_id',
        'profile_id',
        'insight_json'
    ];

    protected $casts = [
        'insight_json' => 'array'
    ];
}
