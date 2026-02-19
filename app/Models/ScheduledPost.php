<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledPost extends Model
{
    protected $fillable = [
        'profile_id',
        'caption',
        'media_url',
        'scheduled_at',
        'status'
    ];

    public function account(){
        return $this->belongsTo(InstagramAccount::class, 'instagram_account_id');
    }
}
