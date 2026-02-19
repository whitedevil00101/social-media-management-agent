<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\ScheduledPost;
use App\Services\Automation\InstagramPublisher;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;

class PublishScheduledPostsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle(InstagramPublisher $publisher)
    {
        $duePosts = ScheduledPost::where('status', 'pending')
            ->where('scheduled_at', '<=', Carbon::now())
            ->get();

        foreach ($duePosts as $post) {
            $post = (ScheduledPost::class === get_class($post)) ? $post : ScheduledPost::findOrFail($post->id);
            $ok = $publisher->publish($post);

            if ($ok) {
                $post->update([
                    'status' => 'posted'
                ]);
            }
        }
    }
}
