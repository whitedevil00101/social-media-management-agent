<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'username',
        'bio',
        'followers',
        'following',
        'posts_count'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function insight()
    {
        return $this->hasOne(ProfileInsight::class);
    }
}
