<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\PostInsight;
use App\Services\Analysis\PostAnalyzerAI;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\AggregateProfileInsightsJob;


class AnalyzePostJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $postId) {}

    public function handle(PostAnalyzerAI $ai)
    {
        $post = Post::find($this->postId);

        if (!$post) return;

        $analysis = $ai->analyze([
            'caption' => $post->caption,
            'media_type' => $post->media_type
        ]);

        PostInsight::updateOrCreate(
            ['post_id' => $post->id],
            [
                'profile_id' => $post->profile_id,
                'insight_json' => $analysis
            ]
        );

        AggregateProfileInsightsJob::dispatch($post->profile_id);
    }
}
