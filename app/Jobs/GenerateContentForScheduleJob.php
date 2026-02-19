<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


use App\Models\ScheduledPost;
use App\Services\Automation\ContentGenerator;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateContentForScheduleJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $profileId) {}

    public function handle(ContentGenerator $generator)
    {
        $ideas = $generator->generateForProfile($this->profileId);

        if (empty($ideas)) return;

        $scheduled = ScheduledPost::where('profile_id', $this->profileId)
            ->where(function($query) {
                $query->whereNull('caption')
                    ->orWhere('caption', 'like', 'Scheduled%');
            })
            ->get();

        $i = 0;

        foreach ($scheduled as $post) {
            if (!isset($ideas[$i])) break;

            if ($post instanceof ScheduledPost) {
                $post->update([
                    'caption' => $ideas[$i]['caption'] ?? $post->caption
                ]);
            }

            $i++;
        }
    }
}
