<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


use App\Services\Automation\SchedulingService;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\GenerateContentForScheduleJob;

class GenerateScheduleJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $profileId) {}

    public function handle(SchedulingService $scheduler)
    {
        $scheduler->generateSchedule($this->profileId);

        GenerateContentForScheduleJob::dispatch($this->profileId);
    }
}
