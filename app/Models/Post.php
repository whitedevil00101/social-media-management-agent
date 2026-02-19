<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'profile_id',
        'instagram_post_id',
        'caption',
        'media_type',
        'media_url',
        'likes',
        'comments',
        'posted_at'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function insight()
    {
        return $this->hasOne(PostInsight::class);
    }
}
