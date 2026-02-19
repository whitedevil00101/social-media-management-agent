<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Services\Aggregation\ProfileInsightAggregator;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\GenerateScheduleJob;

class AggregateProfileInsightsJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $profileId) {}

    public function handle(ProfileInsightAggregator $agg)
    {
        $agg->build($this->profileId);
        GenerateScheduleJob::dispatch($this->profileId);
    }
}
