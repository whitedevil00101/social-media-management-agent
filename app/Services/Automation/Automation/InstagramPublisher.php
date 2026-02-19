<?php

namespace App\Services\Automation;

use App\Models\ScheduledPost;
use Illuminate\Support\Facades\Storage;

class InstagramPublisher
{
    public function __construct(protected InstagramGraphService $graph) {}

    public function publish(ScheduledPost $post): bool
    {
        $account = $post->account;

        if (!$account || !$post->media_path) return false;

        // Convert local media to public URL
        $mediaUrl = asset('storage/' . $post->media_path);

        // 1 create container
        $creationId = $this->graph->createMediaContainer(
            $account->instagram_business_id,
            $account->access_token,
            $mediaUrl,
            $post->caption
        );

        if (!$creationId) return false;

        // 2 publish
        $publishedId = $this->graph->publishContainer(
            $account->instagram_business_id,
            $account->access_token,
            $creationId
        );

        if (!$publishedId) return false;

        // mark posted
        $post->update([
            'status' => 'posted'
        ]);

        return true;
    }
}
