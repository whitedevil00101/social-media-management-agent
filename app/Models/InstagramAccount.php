<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model
{
    protected $fillable = [
        'profile_id',
        'instagram_business_id',
        'page_id',
        'username',
        'access_token',
        'token_expires_at'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }


    public function publish(ScheduledPost $post): bool
    {
        $account = $post->account;

        if (!$account) return false;

        // Graph API call will use:
        // $account->instagram_business_id
        // $account->access_token

        return true;
    }
}
