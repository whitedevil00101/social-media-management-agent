<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Profile;
use App\Services\Instagram\InstagramService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchInstagramPostsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public string $username) {}

    public function handle(InstagramService $instagram)
    {
        $posts = $instagram->fetchPosts($this->username);

        $profile = Profile::firstOrCreate([
            'username' => $this->username
        ]);

        foreach ($posts as $p) {
            $postModel = Post::updateOrCreate(
                ['instagram_post_id' => $p['instagram_post_id']],
                array_merge($p, [
                    'profile_id' => $profile->id
                ])
            );

            AnalyzePostJob::dispatch($postModel->id);
        }
    }
}
