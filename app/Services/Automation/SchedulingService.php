<?php

namespace App\Services\Automation;

use App\Models\ProfileInsight;
use App\Models\ScheduledPost;
use Carbon\Carbon;

class SchedulingService
{
    public function generateSchedule(int $profileId): void
    {
        $profileInsight = ProfileInsight::where('profile_id', $profileId)->first();

        if (!$profileInsight) return;

        $strategy = $profileInsight->insight_json;

        $times = $strategy['optimal_times'] ?? ['18:00'];
        $frequency = $strategy['posting_frequency'] ?? 3;
        $contentMix = $strategy['content_mix'] ?? [];

        for ($i = 0; $i < $frequency; $i++) {
            $time = $times[$i % count($times)];

            $dateTime = $this->nextSlot($time, $i);

            ScheduledPost::create([
                'profile_id' => $profileId,
                'scheduled_at' => $dateTime,
                'caption' => $this->placeholderCaption($contentMix),
                'status' => 'pending'
            ]);
        }
    }

    protected function nextSlot(string $time, int $offset): string
    {
        $base = Carbon::today()->addDays($offset);

        [$h, $m] = explode(':', $time);

        return $base->setTime($h, $m)->toDateTimeString();
    }

    protected function placeholderCaption(array $mix): string
    {
        if (empty($mix)) return "Scheduled content";

        return "Scheduled: " . $mix[array_rand($mix)];
    }
}
